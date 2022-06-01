<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@profile')->middleware('auth')->name('profile');
Route::get('/profile/update/view', 'UserController@profileUpdateView')->middleware('auth')->name('profileUpdateView');
Route::post('/profile/update', 'UserController@profileUpdate')->middleware('auth')->name('profileUpdate');

Route::get('/items', 'ItemController@items')->middleware('auth')->name('items');

Route::post('/items', 'ItemController@addItem')->middleware('auth')->name('addItem');

Route::get('/delete-item/{id}', 'ItemController@deleteItem')->middleware('auth');

