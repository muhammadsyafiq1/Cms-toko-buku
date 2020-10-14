<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('books', 'BookController');
    Route::resource('orders', 'OrderController');
    Route::get('orders/{id}/status','OrderController@status')->name('orders.status');
    Route::get('/ajax/categories/search','CategoryController@ajaxSearch');
});

Auth::routes();
