<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FusersController;

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

Route::get('/', [FusersController::Class,'index'])->name('users.home');

Route::get('users/create', [FusersController::Class,'create'])->name('users.create');

Route::post('users/store', [FusersController::Class,'store'])->name('users.store');

Route::get('users/edit/{id}', [FusersController::Class,'edit'])->name('users.edit');

Route::get('users/delete/{id}', [FusersController::Class,'delete'])->name('users.delete');

Route::get('users/view/{id}', [FusersController::Class,'view'])->name('users.view');

Route::post('/fetch-states', [FusersController::Class,'fetch_state'])->name('fetch_state');

Route::post('/fetch-cities', [FusersController::Class,'fetch_city'])->name('fetch_city');

