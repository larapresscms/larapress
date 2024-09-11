<?php

use Illuminate\Support\Facades\Route;
use LaraPressCMS\LaraPress\Http\Controllers\HomeController;
use LaraPressCMS\LaraPress\Http\Controllers\CategoriesController;
use LaraPressCMS\LaraPress\Http\Controllers\AuthController;
use LaraPressCMS\LaraPress\Http\Controllers\AdminController;
use LaraPressCMS\LaraPress\Http\Controllers\MediaController;
use LaraPressCMS\LaraPress\Http\Controllers\SettingsController; 
use LaraPressCMS\LaraPress\Http\Controllers\PosttypeController;
use LaraPressCMS\LaraPress\Http\Controllers\FeedbacksController;
use LaraPressCMS\LaraPress\Http\Controllers\MenuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/dashboard', [AdminController::class, 'dashboard']);

Route::group(['middleware' => 'admin'], function(){
    // All admin Routes
});

//make category
Route::get('/dashboard/categories/', [CategoriesController::class, 'index']);
Route::get('/dashboard/categories/create', [CategoriesController::class, 'create']);
Route::post('/dashboard/categories', [CategoriesController::class, 'store']);
Route::get('/dashboard/categories/{id}', [CategoriesController::class, 'show']);
Route::get('/dashboard/categories/{id}/edit', [CategoriesController::class, 'edit']);
Route::patch('/dashboard/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/dashboard/categories/{id}', [CategoriesController::class, 'destroy']);

//login registration
// Route::middleware('web')->group(function () {
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'prosessRegister']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });

//show all user for admin----------------------------------
Route::get('/dashboard/showUser', [AdminController::class, 'showUser']);
Route::delete('/dashboard/delete/{id}', [AdminController::class, 'destroy']);
Route::get('/dashboard/user/create', [AdminController::class, 'create']);
Route::get('/dashboard/singleUser/{id}', [AdminController::class, 'singleUser']);
Route::get('/dashboard/user/{id}/edit', [AdminController::class, 'edit']);
Route::patch('/dashboard/user/{id}', [AdminController::class, 'update']);
//show profile
Route::get('/dashboard/profile', [AdminController::class, 'profile']);

//Media controller----------
Route::get('/dashboard/media/', [MediaController::class, 'index']);
Route::get('/dashboard/media/create', [MediaController::class, 'create']);
Route::post('/dashboard/media', [MediaController::class, 'store']);
Route::get('/dashboard/media/{id}', [MediaController::class, 'show']);
Route::get('/dashboard/media/{id}/edit', [MediaController::class, 'edit']);
Route::patch('/dashboard/media/{id}', [MediaController::class, 'update']);
Route::delete('/dashboard/media/{id}', [MediaController::class, 'destroy']);

Route::post('/dashboardajx/media', [MediaController::class, 'storemediaajx']);

Route::get('/dashboard/mediamanager', [MediaController::class, 'mediamanager']);
//ajaxshow
Route::get('/dashboardmediamanager', [MediaController::class, 'dashboardMediaManager']);  

//Settings----- not wrk
Route::get('/dashboard/settings/', [SettingsController::class, 'index']);
//Route::get('/dashboard/settings/create', [SettingsController::class, 'create']);
Route::post('/dashboard/settings/', [SettingsController::class, 'store']);
Route::get('/dashboard/settings/{id}', [SettingsController::class, 'show']);
Route::get('/dashboard/settings/{id}/edit', [SettingsController::class, 'edit']);
Route::patch('/dashboard/settings/{id}', [SettingsController::class, 'update']);
//Route::delete('/dashboard/settings/{id}', [SettingsController::class, 'destroy']);

// Route::get('/dashboard/search', [AdminController::class, 'search']);

//make posttype
Route::get('/dashboard/posttypes/', [PosttypeController::class, 'index']);
Route::get('/dashboard/posttypes/create', [PosttypeController::class, 'create']);
Route::post('/dashboard/posttypes', [PosttypeController::class, 'store']);
Route::get('/dashboard/posttypes/{post_type}', [PosttypeController::class, 'show']);
Route::get('/dashboard/posttypes/{id}/edit', [PosttypeController::class, 'edit']);
Route::patch('/dashboard/posttypes/{id}', [PosttypeController::class, 'update']);
Route::delete('/dashboard/posttypes/{id}', [PosttypeController::class, 'destroy']);
// under posttype
Route::get('/dashboard/posttypes/create/{post_type}', [PosttypeController::class, 'createppost']);
Route::get('/dashboard/posts/posttype/{id}/edit/{post_type}', [PosttypeController::class, 'editppost']);
Route::post('/dashboard/posts/posttypes', [PosttypeController::class, 'storeposttype']);

Route::patch('/dashboard/posts/posttype/{id}', [PosttypeController::class, 'updateppost']);
Route::delete('/dashboard/posts/posttype/{id}', [PosttypeController::class, 'destroyppost']);

//make feedback
Route::get('/dashboard/feedbacks/', [FeedbacksController::class, 'index']);
Route::get('/dashboard/feedbacks/{id}', [FeedbacksController::class, 'show']);
Route::delete('/dashboard/feedbacks/{id}', [FeedbacksController::class, 'destroy']);

//make menu
Route::get('/dashboard/menu/', [MenuController::class, 'index']);
Route::get('/dashboard/menu/create', [MenuController::class, 'create']);
Route::post('/dashboard/menu', [MenuController::class, 'store']);
Route::get('/dashboard/menu/{id}', [MenuController::class, 'show']);
Route::get('/dashboard/menu/{id}/edit', [MenuController::class, 'edit']);
Route::patch('/dashboard/menu/{id}', [MenuController::class, 'update']);
Route::delete('/dashboard/menu/{id}', [MenuController::class, 'destroy']);

// larapress update 
Route::get('/dashboard/clear', [AdminController::class, 'clearCache']);
Route::get('/dashboard/about', [AdminController::class, 'aboutLaraPress']);
Route::get('/dashboard/update', [AdminController::class, 'updateLaraPress']);
Route::get('/update-larapress', [AdminController::class, 'updateLarapressCore'])->name('update-larapress');
Route::get('/update-status', [AdminController::class, 'getStatus']);

//upload template
Route::post('/dashboard/upload-template', [AdminController::class, 'uploadTemplate']);
Route::get('/dashboard/delete-template/{foldername}', [AdminController::class, 'deleteTemplate']);
