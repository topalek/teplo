<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

//Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::resource('category', CategoryController::class);
//    Route::resource('page', PageController::class);
//    Route::resource('product', ProductController::class);
//    Route::resource('param', ParamController::class);
//    Route::resource('seo', SeoController::class);
//    Route::resource('review', ReviewController::class);
//    Route::resource('faq', FaqController::class);
//    Route::resource('service', ServiceController::class);
//    Route::resource('action', ActionController::class);
//    Route::resource('order', OrderController::class);
//});

Auth::routes();

