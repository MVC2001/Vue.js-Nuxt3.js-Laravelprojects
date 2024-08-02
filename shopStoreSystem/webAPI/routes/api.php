<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\UserController;


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


Route::apiResource('facilities',FacilitiesController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/update-password', [AuthController::class, 'updatePassword']);
Route::middleware('auth:sanctum')->get('/user/namev7', [AuthController::class, 'getLoggedUserName']);




Route::post('/registerv1', [UserController::class, 'register']);
Route::post('/loginv1', [UserController::class, 'login']);
Route::post('/logoutv1', [UserController::class, 'logout']);
Route::post('/update-passwordv1', [UserController::class, 'updatePasswordV1']);
Route::middleware('auth:sanctum')->get('/user/namev1', [UserController::class, 'getLoggedUserName']);




