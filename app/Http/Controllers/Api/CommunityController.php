<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
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
            'user_id' => 'required|exists:users,id',
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
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('community_images', 'public');
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

        return response()->json(['success' => true, 'data' => $community], 200);
    }

    // Update a Community
    public function update(Request $request, $id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json(['success' => false, 'message' => 'Community not found'], 404);
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
        if ($request->hasFile('image')) {
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

        $community->delete();

        return response()->json(['success' => true, 'message' => 'Community deleted successfully'], 200);
    }
}
