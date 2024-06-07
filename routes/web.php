<?php

use App\Http\Controllers\auth\otpAdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\ProductController;

Route::view('/', 'welcome')->name('home');

Route::get('/{page:pathname || page:slug}', [PageController::class, 'show']);
Route::get('/services/{service:name}', [ServiceController::class, 'show']);
Route::get('/products/{product:name}', [ProductController::class, 'show']);
Route::get('/solutions/{solution:name}', [SolutionController::class, 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\controllers\UploadController@upload');
});

#Route::get(env('ADM_PANEL_PATH') . '/login/otp', [otpAdminController::class, 'show']);

require __DIR__.'/auth.php';
