<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\allWebsLinksController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@store')->name('register');


Route::get('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@authenticate');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::get('home', 'App\Http\Controllers\HomeController@home')->name('home');
Route::get('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@getEmail');
Route::post('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@postEmail');


Route::get('reset-password/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'App\Http\Controllers\Auth\ResetPasswordController@updatePassword');




Route::get('/update-password', 'App\Http\Controllers\HomeController@showForm')
->middleware('auth')
->name('update-password');
Route::post('/update-password', 'App\Http\Controllers\HomeController@update')->middleware('auth');

Route::get('cacohome', 'App\Http\Controllers\IndexController@homepage');
Route::get('service', 'App\Http\Controllers\ServiceController@service');
Route::get('ourMission', 'App\Http\Controllers\allWebsLinksController@ourMission');
Route::get('newshome', 'App\Http\Controllers\allWebsLinksController@newshome');
Route::get('ourVision', 'App\Http\Controllers\allWebsLinksController@ourVision');
Route::get('cacoteam', 'App\Http\Controllers\allWebsLinksController@cacoteam');
Route::get('cacoBackground', 'App\Http\Controllers\allWebsLinksController@cacoBackground');
Route::get('objectives', 'App\Http\Controllers\allWebsLinksController@objectives');
Route::get('areaOFfocus', 'App\Http\Controllers\allWebsLinksController@areaOFfocus');



Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

//contact routes
Route::get('contact', 'App\Http\Controllers\ContactController@create')->name('contact');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');







