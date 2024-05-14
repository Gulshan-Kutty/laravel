<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/', [StudentController::class,'index'])->name('students.index');
Route::get('students/create', [StudentController::class,'create'])->name('students.create');
Route::post('students/store', [StudentController::class,'store'])->name('students.store');
// Route::get('/', [StudentController::class,'index'])->name('student.index');
// Route::get('/', [StudentController::class,'index'])->name('student.index');
