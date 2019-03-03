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

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/profile', 'Api\ProfileController@show');
    Route::post('/profile', 'Api\ProfileController@update');
    Route::resource('clubs', 'Api\ClubsController', [
        'only' => [
            'store',
            'index',
            'update',
        ]
    ]);
});
