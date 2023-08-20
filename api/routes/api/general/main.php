<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API General Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

    /**
     * Authorized routes
     */
    Route::group([
        'namespace'  => 'General',
        'middleware' => 'auth:api'
    ], function () {

        Route::post('/import','RecordController@import')
            ->name('api.import');
    });
});
