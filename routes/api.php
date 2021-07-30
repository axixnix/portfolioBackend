<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/getblog', [\App\Http\Controllers\BlogController::class, 'getBlog']);

Route::get('/getblogs', [\App\Http\Controllers\BlogController::class, 'getBlogs']);

Route::post('/updateblog', [\App\Http\Controllers\BlogController::class, 'updateBlog']);

Route::post('/deleteblog', [\App\Http\Controllers\BlogController::class, 'deleteBlog']);