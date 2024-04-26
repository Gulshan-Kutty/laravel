<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

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


Route::get('/', [CountryController::Class,'index'])->name('countries.home');

Route::get('countries/create', [CountryController::Class,'create'])->name('countries.create');

Route::post('countries/store', [CountryController::Class,'store'])->name('countries.store');

Route::get('countries/edit/{id}', [CountryController::Class,'edit'])->name('countries.edit');

Route::get('countries/delete/{id}', [CountryController::Class,'delete'])->name('countries.delete');

Route::get('countries/view/{id}', [CountryController::Class,'view'])->name('countries.view');