<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register-user',[ApiController::class,'registerUser']); // 'register-user' is the end point because we write at the end of API url in POSTMAN as Base url will be same(unchangeable) i.e localhost/laravel/project_name/api/

// Route::get('/get-user',[ApiController::class,'getUser']);

// Route::get('/get-single-user-detail/{id}',[ApiController::class,'getSingleUserDetail']);

Route::put('/update-user/{id}',[ApiController::class,'updateUser']); // you can also use 'post' method

Route::delete('/delete-user/{id}',[ApiController::class,'deleteUser']); // you can also use get method

Route::post('/login',[ApiController::class,'login']);

Route::get('/unauthenticate',[ApiController::class,'unauthenticate'])->name('unauthenticate');


// secure routes within auth middleware
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/get-user',[ApiController::class,'getUser']);
    Route::get('/get-single-user-detail/{id}',[ApiController::class,'getSingleUserDetail']);
    Route::post('/logout',[ApiController::class,'logout']);

});