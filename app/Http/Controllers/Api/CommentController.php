<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;
use Auth;
use App\Models\CommentLike;

class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{
            $validator = Validator::make($request->all(), [
                'post_id' => 'required|exists:posts,id',
                'description' => 'required|string',
            ]);
            if($validator->fails())
            {
                return $this->sendError($validator->errors()->first(),500);
            }
            $input = $request->except(['_token'],$request->all());
            $input['user_id'] = Auth::id();
            $data = Comment::create($input);
            return response()->json(['success'=>true,'message'=>'Your Comment has bees post','data'=>$data]);

        }
        catch(\Eception $e)
        {
            return $this->sendError($e->getMessage());

        }
    }

    // Method to add a reply to a comment
    public function addReply(Request $request, $commentId)
    {

        $validator = Validator::make($request->all(), [
            // 'post_id' => 'required|exists:posts,id',
            'description' => 'required|string',
        ]);

        if($validator->fails())
        {
            return $this->sendError($validator->errors()->first(),500);
        }

        $parentComment = Comment::findOrFail($commentId);

        $reply = Comment::create([
            'post_id' => $parentComment->post_id,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'parent_id' => $parentComment->id,
        ]);

        return response()->json(['message' => 'Reply added successfully', 'reply' => $reply], 201);
    }


    public function likeComment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|exists:comments,id',
            // 'description' => 'required|string',
        ]);

        if($validator->fails())
        {
            return $this->sendError($validator->errors()->first(),500);
        }

        $comment = Comment::findOrFail($request->comment_id);
        $userId = auth()->id();

        // Check if the comment is already liked by the user
        if ($comment->isLikedBy($userId)) {
            return response()->json(['message' => 'Already liked'], 400);
        }

        CommentLike::create([
            'comment_id' => $request->comment_id,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Comment liked successfully']);
    }

    // Method to unlike a comment
    public function unlikeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $userId = auth()->id();

        // Find the like record and delete it
        $like = CommentLike::where('comment_id', $commentId)->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Comment unliked successfully']);
        }

        return response()->json(['message' => 'Like not found'], 404);
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
