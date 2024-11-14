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
            $userid = Auth::id();
            $post = Post::withCount('like','comment','comments.replies')->with(['images','comments.user','comments.replies','comments.replies.user','locations','tags','my_like'=> function($query) use ($userid) {
                $query->where('user_id', $userid);
            }])->where('category',$category)->where('user_id',Auth::id())->get();
            return response()->json(['message' => 'Post Lists','post_list'=>$post], 201);
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
            $type = ($request->type == 'image') ? 'image' : 'video';
            $postids = Post::where('user_id',Auth::id())->get()->pluck('id');
            $gallery = PostImage::whereIn('post_id',$postids)->where('type',$type)->get();
            return response()->json(['message' => 'Gallery Lists','gallery_list'=>$gallery], 201);
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
