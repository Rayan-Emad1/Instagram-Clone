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



class Controller extends BaseController{


    public function __construct(){
        $this->middleware('auth:api');
    }


    public function getPosts(Request $request){
        $posts = Post::all();

        return response()->json([
            'status' => 'Success',
            'posts' => $posts,
        ]);
    }

    public function searchUsers(Request $request){
        $query = $request->name;
        $users = User::where('name', 'like', "%$query%")->get();

        return response()->json([
            'status' => 'Success',
            'users' => $users,

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
        $followingId = $request->following_id;

        $isFollowing = Follower::where('follower_id', $user->id)
            ->where('following_id', $followingId)
            ->exists();

        if ($isFollowing) {
            return response()->json([
                'status' => 'Error',
                'message' => 'You are already following this user.',
            ], 400);
        }

        if ($user->id === $followingId) {
            return response()->json([
                'status' => 'Error',
                'message' => 'You cannot follow yourself.',
            ], 400);
        }

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
        $postId = $request->post_id;

        $hasLiked = Like::where('user_id', $user->id)->where('post_id', $postId)->exists();

        if ($hasLiked) {

            Like::where('user_id', $user->id)->where('post_id', $postId)->delete();
            $post = Post::find($postId);
            $post->decrement('likes');
            return response()->json([
                'status' => 'Success',
                'message' => 'Post unliked.',
            ]);
        }

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
        $post->image_url = $request->image_url;
        $post->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Post added.',
        ]);
    }

    public function getPostLikes(Request $request){

        $request->validate([
            'post_id' => 'required|numeric|exists:posts,id',
        ]);
    
        $postId = $request->post_id;
    
        $likedUserIds = Like::where('post_id', $postId)->pluck('user_id');
        $likedUsers = User::whereIn('id', $likedUserIds)->pluck('name');
    
        return response()->json([
            'status' => 'success',
            'liked_users' => $likedUsers,
        ]);
    }

    
}
