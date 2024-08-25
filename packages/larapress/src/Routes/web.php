<?php

use Illuminate\Support\Facades\Route;
use LaraPressCMS\LaraPress\Http\Controllers\HomeController;
use LaraPressCMS\LaraPress\Http\Controllers\CategoriesController;
use LaraPressCMS\LaraPress\Http\Controllers\AuthController;
use LaraPressCMS\LaraPress\Http\Controllers\PostController;
use LaraPressCMS\LaraPress\Http\Controllers\AdminController;
use LaraPressCMS\LaraPress\Http\Controllers\MediaController;
use LaraPressCMS\LaraPress\Http\Controllers\PageController;


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

Route::middleware(['web'])->group(function () {
require 'admin.php'; //for admin
require 'public.php'; //for public
});