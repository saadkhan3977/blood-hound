<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\PostLocation;
use App\Models\PostLike;
use Auth;
use Log;

use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            $category = $request->category;
            $userId = Auth::id();

            $posts = Post::withCount(['like as total_post_like','comment as total_comment' => function ($query) use ($userId) {
                        $query->whereNull('parent_id');
                    }])
                ->with([
                    'images',
                    'locations',
                    'tags',
                    'my_like' => function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    },
                    'comment' => function ($query) use ($userId) {
                    $query->whereNull('parent_id') // Fetch only top-level comments
                        ->withCount('likes as total_comment_likes') // Count likes for each comment
                        ->withCount('replies as total_comment_replies') // Count replies for each comment
                        ->with([
                            'likes', // Load all likes for this comment
                            'user',  // Load comment author info
                            'my_like' => function ($likeQuery) use ($userId) {
                                $likeQuery->where('user_id', $userId); // Specific like by the current user
                            },
                            'replies' => function ($replyQuery) use ($userId) {
                                $replyQuery->withCount('likes as total_reply_likes') // Count likes on each reply
                                    ->with([
                                        'likes',  // Load all likes for this reply
                                        'user',   // Load reply author info
                                        'my_like' => function ($replyLikeQuery) use ($userId) {
                                            $replyLikeQuery->where('user_id', $userId); // Specific like by the current user on replies
                                        }
                                    ]);
                            }
                        ]);
                }
                ])
                ->when($category, function ($query) use ($category) {
                    $query->where('category', $category);
                })
                ->where('user_id', $userId)
                ->get();

            return response()->json(['message' => 'Post List','post_list' => $posts],201);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function gallery(Request $request)
    {
        try
        {
            $postids = Post::where('user_id',Auth::id())->get()->pluck('id');
            if($request->type)
            {
                $type = ($request->type == 'image') ? 'image' : 'video';
                $data[$type] = PostImage::whereIn('post_id',$postids)->where('type',$type)->get();
            }
            else
            {
                $data['image'] = PostImage::whereIn('post_id',$postids)->where('type',"image")->get();
                $data['video'] = PostImage::whereIn('post_id',$postids)->where('type',"video")->get();
                $data['saved_post'] = auth()->user()->savedPosts()->with('post','post.images')->get();
                $data['post'] =  Post::with('images')->where('user_id',Auth::id())->get();
            }
            return response()->json(['message' => 'Gallery Lists','data'=>$data], 201);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function like(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                 'post_id' => 'required|exists:posts,id',
            ]);

            if($validator->fails())
            {
                 return $this->sendError($validator->errors()->first());
            }

            $input['user_id'] = Auth::id();
            $input['post_id'] = $request->post_id;
            $data = PostLike::where(['user_id'=>Auth::id(),'post_id' => $request->post_id])->first();
            if($data)
            {
                $data->delete();
                return response()->json(['success'=>true,'message'=>'Post Dislike Successfully']);
            }
            else
            {
                PostLike::create($input);
                return response()->json(['success'=>true,'message'=>'Post like Successfully']);
            }
        }
        catch(\Eception $e){
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request->all());

    // return $request->all();
    // print_r('saad' );die;
        $validated = \Validator::make($request->all(),[
            'description' => 'required|string',
            'privacy' => 'required',
            'start_time' => 'required',
            'assetname' => 'required',
            'assetcolor' => 'required',
            'end_time' => 'required',
            'category' => 'required|string',
            'location' => 'array',
            'location.*.name' => 'string',
            'location.*.lat' => 'numeric',
            'location.*.lng' => 'numeric',
            'tags' => 'array',
            'tags.*' => 'exists:users,id',
            'images.*' => 'file|mimes:mp4,jpeg,png',
        ]);

        if($validated->fails()) {
            // Log::info($validated->errors());
            return $this->sendError($validated->errors()->first());
        }
        try
        {

            // Create the post
            $post = Post::create([
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'privacy' => $request->privacy,
                'assetcolor' => $request->assetcolor,
                'assetname' => $request->assetname,
                'category' => $request->category,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            if ($request->has('location')) {
                foreach ($request->location as $location) {
                    PostLocation::create([
                        'post_id' => $post->id,
                        'name' => $location['name'],  // Use the 'location' directly from the array
                        'lat' => $location['lat'],
                        'lng' => $location['lng']  // Make sure to use 'lng' here instead of 'name'
                    ]);
                }
            }
            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    // Log::info($image);
                    // Log::info('File MIME Type: ' . $image->getMimeType());

                    $type = $image->getClientOriginalExtension();
                    $filetype =  $image->getMimeType();
                    $imageUrl = $image->store('posts/images', 'public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'file' => $imageUrl,
                        'type' => ($filetype == 'video/mp4') ? 'video' : 'image',
                    ]);
                }
            }



            // Attach tags
            if ($request->has('tags')) {
                foreach ($request->tags as $tagid) {
                    // Create a PostTag for each tag
                    PostTag::create([
                        'post_id' => $post->id,  // Associate the tag with the created post
                        'tag_id' => $tagid,  // Store the tag name directly
                    ]);
                }
            }

            // Commit the transaction
            // \DB::commit();

            return response()->json(['message' => 'Post created successfully'], 201);
        }
        catch(\Eception $e){
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
