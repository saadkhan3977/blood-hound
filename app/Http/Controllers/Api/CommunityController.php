<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    // Get All Communities
    public function index()
    {
        $communities = Community::with('user')->get();
        return response()->json(['success' => true, 'data' => $communities], 200);
    }

    // Create a Community
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'privacy' => 'required|string',
            'visibility' => 'required|string',
            'image' => 'nullable|image|max:2048', // Optional image validation
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Get the user ID from the authenticated user

        // Handle file upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('community_images', 'public'); // Store in storage/app/public/community_images
        }

        $community = Community::create($data);

        return response()->json(['success' => true, 'data' => $community], 201);
    }

    // Show a Single Community
    public function show($id)
    {
        $community = Community::with('user')->find($id);

        if (!$community) {
            return response()->json(['success' => false, 'message' => 'Community not found'], 404);
        }

        // Attach posts where assetname matches community name
        $community->posts = Post::where('assetname', $community->name)->get();

        return response()->json(['success' => true, 'data' => $community], 200);
    }

    // Update a Community
    public function update(Request $request, $id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json(['success' => false, 'message' => 'Community not found'], 404);
        }

        // Ensure the authenticated user is the owner of the community
        if ($community->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'privacy' => 'sometimes|required|string',
            'visibility' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Handle file update
        if ($request->hasFile('image')) {
            // Delete old file
            if ($community->image && Storage::exists("public/{$community->image}")) {
                Storage::delete("public/{$community->image}");
            }

            // Store new file
            $data['image'] = $request->file('image')->store('community_images', 'public');
        }

        $community->update($data);

        return response()->json(['success' => true, 'data' => $community], 200);
    }

    // Delete a Community
    public function destroy($id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json(['success' => false, 'message' => 'Community not found'], 404);
        }

        // Ensure the authenticated user is the owner of the community
        if ($community->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Delete the associated image if it exists
        if ($community->image && Storage::exists("public/{$community->image}")) {
            Storage::delete("public/{$community->image}");
        }

        $community->delete();

        return response()->json(['success' => true, 'message' => 'Community and associated image deleted successfully'], 200);
    }
}
