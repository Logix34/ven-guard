<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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


    Route::post('signup',[UserController::class,'signUp']);
    Route::post('login',[UserController::class,'login']);


    Route::get('dashboard',[UserController::class,'index'])->middleware('auth:sanctum');
