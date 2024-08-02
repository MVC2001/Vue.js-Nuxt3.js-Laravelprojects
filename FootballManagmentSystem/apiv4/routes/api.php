<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OurShopController;
use App\Http\Controllers\GroundAccountContoller;
use App\Http\Controllers\AllCartsController;
use App\Http\Controllers\AllrestedController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ServiceManController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExpensesController;

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


Route::apiResource('groundshop',GroundAccountContoller::class);
Route::apiResource('ourshop',OurShopController::class);
Route::apiResource('addToCartApi',AllCartsController::class);
Route::apiResource('allrequests',AllrestedController::class);
Route::apiResource('vendors',VendorController::class);
Route::apiResource('stocks',StockController::class);
Route::apiResource('servicemans',ServiceManController::class);
Route::apiResource('sales',SalesController::class);
Route::apiResource('expenses',ExpensesController::class);



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/update-password', [AuthController::class, 'updatePassword']);





