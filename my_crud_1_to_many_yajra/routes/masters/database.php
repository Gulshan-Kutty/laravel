<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CustomAuthController;
// use App\Http\Controllers\MailController;
// use App\Http\Controllers\CookieController;


// second & third database connectivity routes
Route::get('/database2',[ProductController::class,'database2'])->name('database2');
Route::get('/database3',[ProductController::class,'database3'])->name('database3');