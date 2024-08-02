<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoriesController;

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





Route::post('/registerv2', [AuthController::class, 'register']);
Route::post('/loginv2', 'App\Http\Controllers\AuthController@login')->name('login');
Route::middleware('auth:sanctum')->post('/logoutv2', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/update-passwordv2', [AuthController::class, 'updatePassword']);
Route::middleware('auth:sanctum')->get('/user/name', 'App\Http\Controllers\AuthController@getLoggedUserName');

//others routes
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/tasksv1', TaskController::class);
Route::apiResource('/categories', CategoriesController::class);




