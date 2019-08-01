<?php

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

Route::get('/{vue?}', function () {
    return view('spa');
})->where('vue', '[\/\w\.-]*');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-home');

    Route::get('login', 'Auth\LoginController@getLogin')->name('getLogin');

    Route::post('login', 'Auth\LoginController@postLogin')->name('postLogin');

    Route::delete('logout', 'Auth\LoginController@logout')->name('logout');
});
