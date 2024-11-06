<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\PostLocation;
use Auth;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $post = Post::where('user_id',Auth::id())->get();
            return response()->json(['message' => 'Post Lists','post_list'=>$post], 201);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
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
        $validated = \Validator::make($request->all(),[
            'description' => 'required|string',
            'privacy' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'category' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'locations' => 'array',
            // 'locations.*' => 'exists:locations,id',
            'tags' => 'array',
            // 'tags.*' => 'exists:post_tags,id',
        ]);

        // Start the transaction to create the post
        // \DB::beginTransaction();
        if($validated->fails()) {
            return response()->json(['success'=>false,'message'=>$validated->errors()],500);    
        }
        try {
            // Create the post
            $post = Post::create([
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'privacy' => $request->privacy,
                'category' => $request->category,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageUrl = $image->store('posts/images', 'public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'file' => $imageUrl,
                    ]);
                }
            }

            // Attach locations
            if ($request->has('location')) {
                foreach ($request->location as $tagName) {
                    // Create a PostTag for each tag
                    PostLocation::create([
                        'post_id' => $post->id,  // Associate the tag with the created post
                        'location' => $tagName,  // Store the tag name directly
                    ]);
                }
            }

            // Attach tags
            if ($request->has('tags')) {
                foreach ($request->tags as $tagName) {
                    // Create a PostTag for each tag
                    PostTag::create([
                        'post_id' => $post->id,  // Associate the tag with the created post
                        'tag' => $tagName,  // Store the tag name directly
                    ]);
                }
            }

            // Commit the transaction
            \DB::commit();

            return response()->json(['message' => 'Post created successfully'], 201);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
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
