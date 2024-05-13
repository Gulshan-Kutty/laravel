<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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

Route::get('/',[CustomAuthController::class,'login'])->name('login')->middleware('islogout'); // if you are already loggedIn and if u try to go to login page/registration page without loggig out then it will prevent it.

Route::get('/registration',[CustomAuthController::class,'registration'])->name('registration')->middleware('islogout');

Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('registerUser');

Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('loginUser');

Route::get('/dashboard',[CustomAuthController::class,'dashboard'])->name('dashboard')->middleware('islogin','preventback');

Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');

// group function

// Route::middleware(['preventBack'])->group(function(){
//     Route::middleware(['isLogIn'])->group(function(){

//         Route::get('/dashboard',[CustomAuthController::class,'dashboard']);

//     });
// });
