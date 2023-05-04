<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterContoller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class);
});

//public routes
Route::post('register', RegisterContoller::class);
Route::post('sign-in', LoginController::class);
