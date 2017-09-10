<?php

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

Route::group(['prefix' => 'ticket', 'middleware' => 'auth.api'], function () {
    Route::get('info', 'SteamTicketController@info');
    Route::get('request', 'SteamTicketController@request');
    Route::get('check', 'SteamTicketController@check');
});
