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
        // Get all books
        Route::get('products', 'Books\BookController@allBooks');

        // Below mention routes are available only for the authenticated users.
            Route::middleware('auth:api')->group(function () {
                // Get user info
                Route::get('user', 'Users\AuthController@user');
                // Logout user from application
                Route::post('logout', 'Users\AuthController@logout');
                // Removes a user
                Route::post('removeuser/{id}', 'Users\UserController@removeUser');
                // Get user address info
                Route::get('userinfo/{id}', 'Users\UserController@userInfo');
                // Update user address info
                Route::put('updateuseraddress/{id}', 'Users\UserController@updateUserAddress');
                // Update user info
                Route::put('updateuser/{id}', 'Users\UserController@updateUser');
                // add product to shopping cart (POST)
                // display product on product details page (GET)
                // display products in users cart (GET)
                Route::get('shoppingcart/{id}', 'Books\BookController@getCartItems');
                // display user cart count on navbar
                Route::get('itemsincart/{id}', 'Books\BookController@getCartItemCount');
                });
        });
// Below mention routes are admin. Non-admin users have no access.
    Route::prefix('admin')->group(function () {
        // Get all book categories
        Route::get('categories', 'Books\BookController@allCategories');
        // Get all publishers
        Route::get('publishers', 'Books\BookController@allPublishers');
        // Get all states
        Route::get('states', 'Books\BookController@allStates');
        // Create a new book
        Route::post('newproduct', 'Books\BookController@addProduct');
        // Create a new publisher
        Route::post('newpublisher', 'Books\BookController@createPublisher');
        // Removes a product
        Route::post('removeproduct/{id}', 'Books\BookController@removeProduct');
        // Updates a product
        Route::put('updateproduct/{id}', 'Books\BookController@updateProduct');
        // Gets all data needed for admin panel
        Route::get('all', 'Books\BookController@allAdmin');
    });
});
