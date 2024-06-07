<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CookieController;

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

// product crud routes
Route::get('/home', [ProductController::Class,'index'])->name('products.home')->middleware('islogin','preventback');

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



// login related routes
Route::get('/',[CustomAuthController::class,'login'])->name('login')->middleware('islogout'); // if you are already loggedIn and if u try to go to login page/registration page without logging out then it will prevent it.

Route::get('/registration',[CustomAuthController::class,'registration'])->name('registration')->middleware('islogout');

Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('registerUser');

Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('loginUser');

Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');


// // second & third database connectivity routes
// Route::get('/database2',[ProductController::class,'database2'])->name('database2');
// Route::get('/database3',[ProductController::class,'database3'])->name('database3');
// require_once('routes/masters/database.php');
// @include('routes/masters/database.php');
@require('routes/masters/database.php');

// email sending routes
Route::get('mail-form',[MailController::class,'mailForm'])->name('mailForm');
Route::post('send-mail',[MailController::class,'sendMail'])->name('sendMail');

// Cookie related routes
Route::get('/set-cookie',[CookieController::class,'setcookie'])->name('setcookie');
Route::get('/get-cookie',[CookieController::class,'getcookie'])->name('getcookie');
Route::get('/delete-cookie',[CookieController::class,'deletecookie'])->name('deletecookie');