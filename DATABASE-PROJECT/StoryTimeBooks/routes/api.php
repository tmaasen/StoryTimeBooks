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
                // Removes a user
                Route::post('removeuser/{id}', 'Users\UserController@removeUser');
                        });
        });
// Below mention routes are admin. Non-admin users have no access.
    Route::prefix('admin')->group(function () {
        // Get all users info
        Route::get('users', 'Users\UserController@allUsers');
        // Get all books
        Route::get('products', 'Books\BookController@allBooks');
        // Get all book categories
        Route::get('categories', 'Books\BookController@allCategories');
        // Get all publishers
        Route::get('publishers', 'Books\BookController@allPublishers');
        // Get all states
        Route::get('states', 'Books\BookController@allStates');
        // Create a new book
        Route::post('newproduct', 'Books\BookController@createBook');
        // Create a new publisher
        Route::post('newpublisher', 'Books\BookController@createPublisher');
        // Removes a product
        Route::post('removeproduct/{id}', 'Books\BookController@removeProduct'); // PROBLEM CHILD
    });
});