<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CoustomerController;

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
})->name('/');
//Auth
Route::get('coustomer/registartion', [AuthController::class, 'registration'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'coustomerRegistration'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [PostController::class, 'index'])->name('home');
    //post
    Route::get('create/post', [PostController::class, 'createPost'])->name('createPost');
    Route::post('submit/post', [PostController::class, 'submitPost'])->name('submitPost');
    Route::delete('delete/post/{id}', [PostController::class, 'deletetPost'])->name('deletePost');

    //coustomer
    Route::get('edit/profile', [AuthController::class, 'editProfile'])->name('editProfile');
    Route::post('update/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
});


Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('coustomer/list', [CoustomerController::class, 'coustomerList'])->name('coustomerList');
    Route::delete('coustomer/{id}', [CoustomerController::class, 'coustomerDestroy'])->name('coustomerDelete');
    Route::delete('coustomer/muliple/destroy', [CoustomerController::class, 'coustomerMulipleDestroy'])->name('coustomerMulipleDestroy');

    Route::get('post/list', [PostController::class, 'index'])->name('postList');
});