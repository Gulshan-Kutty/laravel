<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JqueryController;
use App\Http\Controllers\DropdownController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jquery', [JqueryController::Class,'jquery'])->name('jquery');


Route::get('/', [DropdownController::Class,'index'])->name('index');
Route::post('/fetch-states', [DropdownController::Class,'fetch_state'])->name('fetch_state');
Route::post('/fetch-cities', [DropdownController::Class,'fetch_city'])->name('fetch_city');

