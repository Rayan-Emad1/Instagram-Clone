<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/signin', [AuthController::class, 'signIn']);
Route::post('/signup', [AuthController::class, 'signUp']);


Route::group(["middleware" => "auth:api"], function(){
    $user = Auth::user(); 
  
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
