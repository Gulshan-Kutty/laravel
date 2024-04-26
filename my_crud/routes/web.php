<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductController_relation_1_to_1;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// use these routes for one to one and one to many but without any relation

Route::get('/', [ProductController::Class,'index'])->name('products.home');

Route::get('products/create', [ProductController::Class,'create'])->name('products.create');

Route::post('products/store', [ProductController::Class,'store'])->name('products.store');

Route::get('products/edit/{id}', [ProductController::Class,'edit'])->name('products.edit');

Route::get('products/delete/{id}', [ProductController::Class,'delete'])->name('products.delete');

Route::get('products/view/{id}', [ProductController::Class,'view'])->name('products.view');



// use these routes for one to one relation

// Route::get('/', [ProductController_relation_1_to_1::Class,'index'])->name('products.home');

// Route::get('products/create', [ProductController_relation_1_to_1::Class,'create'])->name('products.create');

// Route::post('products/store', [ProductController_relation_1_to_1::Class,'store'])->name('products.store');

// Route::get('products/edit/{id}', [ProductController_relation_1_to_1::Class,'edit'])->name('products.edit');

// Route::get('products/delete/{id}', [ProductController_relation_1_to_1::Class,'delete'])->name('products.delete');

// Route::get('products/view/{id}', [ProductController_relation_1_to_1::Class,'view'])->name('products.view');