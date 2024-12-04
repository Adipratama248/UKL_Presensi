<?php

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



Route::post('/register', App\Http\Controllers\Api\RegisterController::class);

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

use App\http\Controllers\user1Controller;
Route::middleware('auth:api')->put('/updateuser/{id}', [user1Controller::class,'updateuser']);
Route::middleware('auth:api')->delete('/deleteuser/{id}', [user1Controller::class,'d1']);
Route::middleware('auth:api')->get('/user/{id}', [user1Controller::class,'show']);


use App\http\Controllers\kehadiranController;
Route::post('/attendance',[kehadiranController::class,'presensi']);
Route::middleware('auth:api')->get('/attendance/history/{id}', [kehadiranController::class,'show1']);
Route::middleware('auth:api')->get('/attendance/summary/{id}', [kehadiranController::class,'summary']);
Route::middleware('auth:api')->post('/attendance/analysis',[kehadiranController::class,'analysis']);
