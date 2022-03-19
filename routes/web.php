<?php

use Illuminate\Support\Facades\Route;
use App\Http\Libraries\BaseApi;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});
Route::post('store', [UserController::class, 'store'])->name('store');
Route::put('update',[UserController::class, 'update'])->name('update');
Route::get('destroy/{id}',[UserController::class, 'destroy'])->name('destroy');
Route::resource('users', UserController::class);

