<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\SavedPost;
use Auth;

class SavedPostController extends Controller
{
    public function toggleSave(Request $request, $postId)
    {
        $user = auth()->user();
        $savedPost = SavedPost::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();

        if ($savedPost) {
            $savedPost->delete(); // Unsave the post if it already exists
            return response()->json(['message' => 'Post unsaved successfully']);
        }

        // Save the post
        SavedPost::create([
            'user_id' => $user->id,
            'post_id' => $postId,
        ]);

        return response()->json(['message' => 'Post saved successfully']);
    }

    public function getSavedPosts()
    {
        $savedPosts = auth()->user()->savedPosts()->with('post')->get();
        return response()->json($savedPosts);
    }
}
