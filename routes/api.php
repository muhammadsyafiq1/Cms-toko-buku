<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Book as BookResource;
use App\Models\Book;

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



Route::prefix('v1')->group(function(){
    // public
    Route::post('login','API\AuthController@login');
    Route::post('register','API\AuthController@register');

    Route::get('categories/random/{count}','API\CategoryController@random');
    Route::get('books/top/{count}','API\BookController@top');

    Route::get('categories/','API\CategoryController@index');
    Route::get('category/slug/{slug}','API\CategoryController@slug');

    Route::get('books/','API\BookController@index');
    Route::get('book/slug/{slug}','API\BookController@slug');

    Route::get('books/search/{keyword}','API\BookController@search');

    // private
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout','API\AuthController@logout');
    });
});



