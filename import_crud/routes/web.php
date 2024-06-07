<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;

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


// country master routes
Route::get('/', [CountryController::Class,'list'])->name('countries.list');

Route::get('ajax_country', [CountryController::Class,'ajax_country'])->name('countries.ajax_country'); // route for Yajra Datatable.

Route::get('countries/create', [CountryController::Class,'create'])->name('countries.create');

Route::post('countries/store', [CountryController::Class,'store'])->name('countries.store');

Route::post('countries/import',[CountryController::class,'import'])->name('countries.import');


// // state master routes
// Route::get('/', [CountryController::Class,'index'])->name('states.index');

// Route::get('ajax_state', [CountryController::Class,'ajax_state'])->name('states.ajax_state'); // route for Yajra Datatable.

// Route::get('states/create', [CountryController::Class,'create'])->name('states.create');

// Route::post('states/store', [CountryController::Class,'store'])->name('states.store');

// Route::post('states/import',[CountryController::class,'import'])->name('states.import');


// // city master routes
// Route::get('/', [CountryController::Class,'index'])->name('cities.index');

// Route::get('ajax_product', [CountryController::Class,'ajax_city'])->name('cities.ajax_city'); // route for Yajra Datatable.

// Route::get('cities/create', [CountryController::Class,'create'])->name('cities.create');

// Route::post('cities/store', [CountryController::Class,'store'])->name('cities.store');

// Route::post('cities/import',[CountryController::class,'import'])->name('cities.import');