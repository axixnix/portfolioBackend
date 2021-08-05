<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use App\Newsletter;

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

Route::prefix("auth")->group(function() {
    Route::post('/register', [RegisterController::class, 'registerUser']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('forgot-password', [\App\Http\Controllers\VerificationController::class, 'resetPassword']);

    Route::post('change-password', [\App\Http\Controllers\VerificationController::class, 'changePassword']);

    // Verify email
});

Route::prefix('blogs')->group(function () {
    Route::get('/{id}', [\App\Http\Controllers\BlogController::class, 'getBlog']); //worked

    Route::get('/', [\App\Http\Controllers\BlogController::class, 'getBlogs']); //worked

    Route::post('/search', [SearchController::class, 'search']);

    Route::middleware('PortfolioAuth')->group(function () {
        Route::post('/', [\App\Http\Controllers\BlogController::class, 'createBlog']); //

        Route::put('/{id}', [\App\Http\Controllers\BlogController::class, 'updateBlog']); //404

        Route::delete('/{id}', [\App\Http\Controllers\BlogController::class, 'deleteBlog']); //404 not working
    });
});

Route::prefix('news-letter')->group(function() {
    Route::get('/emails', [NewsletterController::class, 'getEmails']);
    Route::post('/subscribe', [NewsletterController::class, 'saveEmail']);
});

Route::prefix('site')->group(function() {
    Route::get('/home', [SiteController::class, 'getHomePage']);
    Route::get('/content', [SiteController::class, 'getSite']);

    Route::middleware('PortfolioAuth')->group(function () {
        Route::post('/upload-profile-pic', [ImageController::class, 'imageUpload']);
        Route::post('/update-site', [SiteController::class, 'updateSite']);
    });
});













