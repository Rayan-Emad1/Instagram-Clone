<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Follower;


class Controller extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function searchUsers(Request $request){
        $query = $request->input('query');
        $users = User::where('name', 'like', "%$query%")
                     ->orWhere('username', 'like', "%$query%")
                     ->get();

        return response()->json([
            'status' => 'Success',
            'users' => $users,
        ]);
    }

    public function getPosts(Request $request){
        $posts = Post::all();

        return response()->json([
            'status' => 'Success',
            'posts' => $posts,
        ]);
    }

    public function getPersonalPosts(Request $request){
        $user = Auth::user();
        $personalPosts = Post::where('user_id', $user->id)->get();

        return response()->json([
            'status' => 'Success',
            'posts' => $personalPosts,
        ]);
    }

    public function addFollower(Request $request){
        $user = Auth::user();
        $followingId = $request->input('following_id');

        // Check if the user is already following this user using a Follower model
        $isFollowing = Follower::where('follower_id', $user->id)
            ->where('following_id', $followingId)
            ->exists();

        if ($isFollowing) {
            return response()->json([
                'status' => 'Error',
                'message' => 'You are already following this user.',
            ], 400);
        }

        // Prevent self-following
        if ($user->id === $followingId) {
            return response()->json([
                'status' => 'Error',
                'message' => 'You cannot follow yourself.',
            ], 400);
        }

        // Add the following relationship using the Follower model
        Follower::create([
            'follower_id' => $user->id,
            'following_id' => $followingId,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'You are now following the user.',
        ]);
    }

    public function addLike(Request $request){
        $user = Auth::user();
        $postId = $request->input('post_id');

        // Check if the user has already liked the post
        $hasLiked = Like::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->exists();

        if ($hasLiked) {
            // Remove the like
            Like::where('user_id', $user->id)
                ->where('post_id', $postId)
                ->delete();

            $post = Post::find($postId);
            $post->decrement('likes');

            return response()->json([
                'status' => 'Success',
                'message' => 'Post unliked.',
            ]);
        }

        // Like the post
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $postId;
        $like->save();

        $post = Post::find($postId);
        $post->increment('likes');

        return response()->json([
            'status' => 'Success',
            'message' => 'Post liked.',
        ]);
    }

    public function addPost(Request $request){
        $user = Auth::user();

        $post = new Post();
        $post->user_id = $user->id;
        $post->image_url = $request->input('image_url');
        $post->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Post added.',
        ]);
    }
    
}
