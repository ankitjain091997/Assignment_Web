<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/user/create', function () {
    return view('UserCreateForm');
});
Route::post('user/add', [UserController::class, 'createUser'])->name('user/add');
Route::get('users', function () {
    return view('userList');
});
Route::get('user/list', [UserController::class, 'userList'])->name('user/list');