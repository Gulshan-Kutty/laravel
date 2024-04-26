<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::Class,'index'])->name('products.home');

Route::get('ajax_product', [ProductController::Class,'ajax_product'])->name('products.ajax_product'); // route for Yajra Datatable.

Route::get('products/create', [ProductController::Class,'create'])->name('products.create');

Route::post('products/store', [ProductController::Class,'store'])->name('products.store');

Route::get('products/edit/{id}', [ProductController::Class,'edit'])->name('products.edit');

Route::get('products/delete/{id}', [ProductController::Class,'delete'])->name('products.delete');

Route::get('products/view/{id}', [ProductController::Class,'view'])->name('products.view');

Route::post('products/export/', [ProductController::Class,'export'])->name('products.export');

Route::post('products/import',[ProductController::class,'import'])->name('products.import');

Route::get('products/pdf',[ProductController::class,'pdf'])->name('products.pdf');

Route::post('products/update-status', [ProductController::class,'updatestatus'])->name('products.update_status');
