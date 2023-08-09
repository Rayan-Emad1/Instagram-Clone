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

}
