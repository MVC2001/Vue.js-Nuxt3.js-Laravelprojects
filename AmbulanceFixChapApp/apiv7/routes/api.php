<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ComfirmedOrders;
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


Route::apiResource('/ambulances',AmbulanceController::class);


//user controller
Route::post('/registerv6', [AuthController::class, 'register']);
Route::post('/loginv6', 'App\Http\Controllers\AuthController@login')->name('login');
Route::middleware('auth:sanctum')->post('/logoutv6', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/update-passwordv6', [AuthController::class, 'updatePassword']);
Route::middleware('auth:sanctum')->get('/user/name', 'App\Http\Controllers\AuthController@getLoggedUserName');



//admin
Route::post('/register', [AdminController::class, 'register']);
Route::post('/loginv7', 'App\Http\Controllers\AdminController@login')->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AdminController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/update-passwordv7', [AdminController::class, 'updatePassword']);
Route::middleware('auth:sanctum')->get('/user/namev7', 'App\Http\Controllers\AdminController@getLoggedUserName');





