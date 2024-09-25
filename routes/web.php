<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/greetings', 'GreetingController@index')->name('greetings.index');
Route::post('/submit-greeting', 'GreetingController@store')->name('submit.greeting');

Route::get('/login', 'Management\Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Management\Auth\LoginController@logout')->name('logout');
Route::post('/login/process', 'Management\Auth\LoginController@login')->name('login.process');

Route::prefix('mgt')->name('mgt.')->group(function () {
  Route::middleware(Authenticate::class)->group(function () {
    Route::get('/', 'Management\DashboardController@index')->name('dashboard');

    Route::prefix('gift')->name('gift.')->group(function () {
      Route::get('/', 'Management\GiftController@index')->name('index');
      Route::get('/create', 'Management\GiftController@create')->name('create');
      Route::post('/store', 'Management\GiftController@store')->name('store');
      Route::get('/{id}/edit', 'Management\GiftController@edit')->name('edit');
      Route::put('/{id}', 'Management\GiftController@update')->name('update');
      Route::delete('/{id}', 'Management\GiftController@destroy')->name('destroy');
    });

  });
});