<?php

use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ParamController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::resource('category', CategoryController::class);
Route::resource('page', PageController::class);
Route::resource('product', ProductController::class);
Route::resource('param', ParamController::class);
Route::resource('seo', SeoController::class);
Route::resource('review', ReviewController::class);
Route::resource('faq', FaqController::class);
Route::resource('service', ServiceController::class);
Route::resource('action', ActionController::class);
Route::resource('order', OrderController::class);
