<?php

use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'Users\AuthController@register');
        // Login User
        Route::post('login', 'Users\AuthController@login');
                
        // Refresh the JWT Token
        Route::get('refresh', 'Users\AuthController@refresh');
                
            // Below mention routes are available only for the authenticated users.
            Route::middleware('auth:api')->group(function () {
                // Get user info
                Route::get('user', 'Users\AuthController@user');
                // Logout user from application
                Route::post('logout', 'Users\AuthController@logout');
                // Get all users info
                Route::get('users', 'Users\UserController@allUsers');
                        });
        });
});