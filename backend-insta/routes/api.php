<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;


Route::post('/signin', [AuthController::class, 'signIn']);
Route::post('/signup', [AuthController::class, 'signUp']);


Route::group(["middleware" => "auth:api"], function(){
    $user = Auth::user(); 

    Route::get('/users/search', [Controller::class, 'searchUsers']);
    Route::get('/posts', [Controller::class, 'getPosts']);
    Route::get('/posts/personal', [Controller::class, 'getPersonalPosts']);
    Route::post('/follow', [Controller::class, 'addFollower']);
    Route::post('/like', [Controller::class, 'addLike']);
    Route::post('/posts', [Controller::class, 'addPost']);

  
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
