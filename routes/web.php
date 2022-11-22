<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/update', function () {
    return view('update');
});

Route::resource('products', ProductController::class);

Route::get('login1', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('profileUpdate', [AuthController::class, 'profileUpdate'])->name('profileUpdate'); 

Route::get('/change-password', [PasswordChangeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [PasswordChangeController::class, 'updatePassword'])->name('update-password');


Route::get('/list','App\Http\Controllers\ListController@index');
Route::post('/list', 'App\Http\Controllers\ListController@create');
Route::post('/update', 'App\Http\Controllers\ListController@update');
Route::post('/delete', 'App\Http\Controllers\ListController@delete');
Route::get('/search','App\Http\Controllers\ListController@search');