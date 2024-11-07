<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\PostLocation;
use Auth;

use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
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
            $post = Post::with('images','locations','tags')->where('user_id',Auth::id())->get();
            return response()->json(['message' => 'Post Lists','post_list'=>$post], 201);
        } 
        catch (\Exception $e) 
        {
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
        try 
        {
            $validated = \Validator::make($request->all(),[
                'description' => 'required|string',
                'privacy' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'category' => 'required|string',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'location' => 'required|array',
                'tags' => 'required|array',
                'tags.*' => 'exists:users,id',
            ]);

            // Start the transaction to create the post
            // \DB::beginTransaction();
            if($validated->fails()) {
                return $this->sendError($validated->errors()->first());
            }

            
            // Create the post
            $post = Post::create([
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'privacy' => $request->privacy,
                'category' => $request->category,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            if ($request->has('location')) {
                foreach ($request->location as $location) {
                    PostLocation::create([
                        'post_id' => $post->id,  // Associate the tag with the created post
                        'location' => $location,  // Store the tag name directly
                    ]);
                }
            }

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
        catch (\Exception $e) {
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
