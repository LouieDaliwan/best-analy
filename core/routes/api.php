<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *------------------------------------------------------------------------------
 * API Routes
 *------------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
 */

Route::middleware('json.force')->prefix('v1')->group(function () {
    Route::post('login', 'Api\Auth\LoginController@login')->name('login');
    Route::post('logout', 'Api\Auth\LoginController@logout')->name('login');
    Route::post('register', 'Api\Auth\RegisterController@register')->name('register');
});

Route::middleware(['auth:api', 'json.force', 'client.credentials'])->prefix('v1')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout')->name('logout');

    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
