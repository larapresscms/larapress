<?php
use Illuminate\Support\Facades\Route;
use LaraPressCMS\LaraPress\Http\Controllers\HomeController;
Route::get('/migrate', [HomeController::class, 'migrate']);
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear'); 
    return "Cleared!"; 
 });
Route::get('/', [HomeController::class, 'index']);
Route::get('/searchall', [HomeController::class, 'searchAll'])->name('public.search');
Route::get('/sendmail', [HomeController::class, 'sendmail']);
Route::post('/feedbacks', [HomeController::class, 'feedbacksstore']); 
Route::get('/{any}', [HomeController::class, 'handleDynamicRoute'])->where('any', '.*');