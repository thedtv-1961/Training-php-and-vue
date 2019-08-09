<?php

use Illuminate\Http\Request;

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
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Api\AuthController@signup');

    Route::post('login', 'Api\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::delete('logout', 'Api\AuthController@logout');

        Route::get('user', 'Api\AuthController@getUser');
    });
});

Route::group(['prefix' => 'forgot-password'], function () {
    Route::post('/', 'Api\ResetPasswordController@sendMail');
    Route::post('token', 'Api\ResetPasswordController@checkToken');
    Route::post('reset', 'Api\ResetPasswordController@reset');
});

Route::group(['namespace' => 'Api\User', 'middleware' => 'auth:api'], function () {
    Route::resource('users', 'ProfileController', [
        'only' => [
            'show',
            'update',
        ]
    ]);

    Route::post('/change-avatar', 'ProfileController@changeAvatar');

    Route::apiResource('announcements', 'AnnouncementController', [
        'only' => [
            'index',
            'show',
        ]
    ]);

    Route::patch('notifications', 'NotificationController@update');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
    Route::group(['namespace' => 'User'], function () {
        Route::apiResource('groups', 'GroupController', [
            'only' => [
                'index'
            ]
        ]);
    });

    Route::post('/change-email-request', 'ChangeEmailRequestController@changeEmailRequest');
});
