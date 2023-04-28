<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('deleteRecord', [JobsController::class, 'deleteRecord']);
Route::post('login', [JobsController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('/user')->group(function () {
    Route::patch('update', [JobsController::class, 'update']);
});