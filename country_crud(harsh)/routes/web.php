<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Models\City;
use App\Models\User;

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
//middleware without prevent back history
// Route::group(['middleware' => 'islogin'], function () {
//middleware with prevent back history
// Route::get('/', [AuthController::class, 'login'])->name('auth.login')->middleware('islogout');

Route::middleware(['preventBackHistory', 'islogin'])->group(function () {
    Route::get('/country/jquery_tuto', function () {
        return view('country.jquery_tuto');
    })->name('country.jquery_tuto');

    Route::get('/index', [CountryController::class, 'index'])->name('country.index');
    Route::post('/country/store', [CountryController::class, 'store'])->name('country.store');
    Route::get('/country/create', [CountryController::class, 'create'])->name('country.create');
    Route::get('/country/view/{id}', [CountryController::class, 'show'])->name('country.show');
    Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::get('/country/delete/{id}', [CountryController::class, 'distroy'])->name('country.delete');


    Route::get('/index/state', [StateController::class, 'index'])->name('state.index');
    Route::get('/create/state', [StateController::class, 'create'])->name('state.create');
    Route::post('/state/store', [StateController::class, 'store'])->name('state.store');
    Route::post('/create/fetch-state', [StateController::class, 'fetchstate'])->name('state.fetchstate');
    Route::get('/show/state/{id}', [StateController::class, 'show'])->name('state.show');
    Route::get('/update/state/{id}', [StateController::class, 'update'])->name('state.update');
    Route::get('/delete/state/{id}', [StateController::class, 'distroy'])->name('state.delete');



    Route::get('/index/city', [CityController::class, 'index'])->name('city.index');
    Route::get('/create/city', [CityController::class, 'create'])->name('city.create');
    Route::post('/city/store', [CityController::class, 'store'])->name('city.store');
    Route::post('/create/fetch-city', [CityController::class, 'fetchcity'])->name('state.fetchcity');
    Route::get('/show/city/{id}', [CityController::class, 'show'])->name('city.show');
    Route::get('/update/city/{id}', [CityController::class, 'update'])->name('city.update');
    Route::get('/delete/city/{id}', [CityController::class, 'distroy'])->name('city.delete');





    Route::get('/ajax/create', [UserController::class, 'ajax'])->name('user.ajax');


    Route::get('/yajra/index', [UserController::class, 'yajra'])->name('user.yajra');

    Route::get('/dummy', [UserController::class, 'import_dummy'])->name('user.import_dummy');

    
    Route::post('/import', [UserController::class, 'import'])->name('user.import');
    
    Route::get('/pdf', [UserController::class, 'pdf'])->name('user.pdf');
    
    Route::post('/statuschange', [UserController::class, 'status'])->name('user.status');
    
    
    Route::get('/index/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/create/user', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/show/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/update/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/delete/user/{id}', [UserController::class, 'distroy'])->name('user.delete');
    Route::get('/multi_img', [UserController::class, 'multi_img'])->name('user.multi_img');
    Route::post('/multi_img_data', [UserController::class, 'multi_img_data'])->name('user.img_data');
    
    Route::get('/set-cookie',[UserController::class,'setcookie'])->name('setcookie');
    Route::get('/get-cookie',[UserController::class,'getcookie'])->name('getcookie');
    Route::get('/delete-cookie',[UserController::class,'deletecookie'])->name('deletecookie');
    
});
Route::get('/send-mailpage', [UserController::class, 'mailpage'])->name('user.mailpage');

Route::post('/send-mail', [UserController::class, 'mail'])->name('user.mail');

Route::post('/export/date', [UserController::class, 'export_d'])->name('user.export_d');


Route::get('/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/register/data', [AuthController::class, 'registerData'])->name('auth.registerData');

// Route::middleware(['preventBackHistory', 'islogout'])->group(function () {
Route::get('/', [AuthController::class, 'login'])->name('auth.login')->middleware('islogout');
// });

Route::put('/login/data', [AuthController::class, 'loginData'])->name('auth.loginData');
Route::get('logout', [AuthController::class, 'logoutFlush'])->name('logout.flush');
