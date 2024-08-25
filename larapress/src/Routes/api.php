<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaraPressVendor\LaraPress\Models\Post;
use LaraPressVendor\LaraPress\Http\Controllers\PostApiController; 
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['web'])->group(function () {
Route::get('/posts', [PostApiController::class, 'index']);
Route::post('/posts', [PostApiController::class, 'store']);
Route::put('/posts/{post}', [PostApiController::class, 'update']);
Route::delete('/posts/{post}', [PostApiController::class, 'destroy']);

Route::get('/versioncontroll', [PostApiController::class, 'versionControll']);
});
