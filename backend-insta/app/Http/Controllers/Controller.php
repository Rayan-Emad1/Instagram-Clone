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

    public function getPosts(Request $request){
        $posts = Post::all();

        return response()->json([
            'status' => 'Success',
            'posts' => $posts,
        ]);
    }

    public function searchUsers(Request $request){
        $query = $request->input('name');
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
        $followingId = $request->input('following_id');

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

    

}
