<?php

use Illuminate\Support\Facades\Route;
use LaraPressVendor\LaraPress\Http\Controllers\HomeController;
use LaraPressVendor\LaraPress\Http\Controllers\CategoriesController;
use LaraPressVendor\LaraPress\Http\Controllers\AuthController;
use LaraPressVendor\LaraPress\Http\Controllers\PostController;
use LaraPressVendor\LaraPress\Http\Controllers\AdminController;
use LaraPressVendor\LaraPress\Http\Controllers\MediaController;
use LaraPressVendor\LaraPress\Http\Controllers\PageController;


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