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
 
// we are calling/loading home route through controller
Route::get('/',[ProductController::class,'index'])->name('products.index'); 

Route::get('/products/create',[ProductController::class,'create'])->name('products.create');

Route::post('/products/store',[ProductController::class,'store'])->name('products.store');  

Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('products.edit'); 
 
Route::get('/products/delete/{id}',[ProductController::class,'delete'])->name('products.delete');  



