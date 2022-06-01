<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    //Auth::guard('api')->user(); // instance of the logged user
    //Auth::guard('api')->check(); // if a user is authenticated
    //Auth::guard('api')->id(); // the id of the authenticated user
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@api_login');
Route::post('logout', 'Auth\LoginController@api_logout')->middleware('auth:api');;

Route::get('/items/', 'ItemController@index')->middleware('auth:api');
Route::get('/items/{id}', 'ItemController@getItem')->middleware('auth:api');
