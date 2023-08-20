<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Admin Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

    /**
     * Unauthorized routes
     */
    Route::group([
        'namespace'  => 'General',
        'prefix'     => 'auth',
        'middleware' => 'auth:api'
    ], function ()
    {

        /**
         * Logout
         */
        Route::post('logout', 'AuthController@logout')
            ->name('api.auth.logout');
    });
});
