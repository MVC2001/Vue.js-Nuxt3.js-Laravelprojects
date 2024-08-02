<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentResetPasswordController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\ResultSleepsController;
 use App\Http\Controllers\ApplicationStatusController;
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



//Admn routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);



//student auth routes
Route::post('/student/register', [StudentAuthController::class, 'register']);
Route::post('/student/login', [StudentAuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/student/user', [StudentAuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/student/logout', [StudentAuthController::class, 'logout']);
Route::post('/student/reset-password', [StudentResetPasswordController::class, 'resetPassword']);
Route::get('/students', [StudentAuthController::class, 'getAllStudents']);
Route::get('/student/applications/{id}/download', [StudentApplicationController::class, 'downloadFile']);


//student application routes
Route::get('/student/applications', [StudentApplicationController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/student/applications/{id}', [StudentApplicationController::class, 'show']);
    Route::post('/student/apply', [StudentApplicationController::class, 'store']);
    Route::put('/student/applications/{id}', [StudentApplicationController::class, 'update']);
    Route::delete('/student/applications/{id}', [StudentApplicationController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/sleeps', [ResultSleepsController::class, 'index']);
    Route::get('/sleepsHistory', [ResultSleepsController::class, 'history']);
    Route::post('/sleeps', [ResultSleepsController::class, 'store']);
    Route::get('/sleeps/{id}', [ResultSleepsController::class, 'show']);
    Route::put('/sleeps/{id}', [ResultSleepsController::class, 'update']);
    Route::delete('/sleeps/{id}', [ResultSleepsController::class, 'destroy']);
    Route::get('/application-status', [ApplicationStatusController::class, 'fetchStatus']);

});
