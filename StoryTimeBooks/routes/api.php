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
        Route::get('products', 'BookController@allBooksToDisplay');

        // Below mention routes are available only for the authenticated users.
            Route::middleware('auth:api')->group(function () {
                // Get user info
                Route::get('user', 'Users\AuthController@user');
                // Logout user from application
                Route::post('logout', 'Users\AuthController@logout');
                // Removes a user
                Route::post('removeuser/{id}', 'Users\UserController@removeUser');
                // Get user address info
                Route::get('userinfo/{id}', 'Users\UserController@allUserInfo');
                // Update user address info
                Route::put('updateuseraddress/{id}', 'Users\UserController@updateUserAddress');
                // Update user info
                Route::put('updateuser/{id}', 'Users\UserController@updateUser');
                // add product to shopping cart (POST)
                Route::post('addtocart/{id}', 'BookController@addToCart');
                // remove product from shopping cart
                Route::post('removefromcart/{id}', 'BookController@removeFromCart');
                // update cart quantity for specific item
                Route::put('updatecartquantity/{id}', 'BookController@setCartQuantity');
                // display products in users cart (GET)
                Route::get('shoppingcart/{id}', 'BookController@getCartItems');
                // display user cart count on navbar
                Route::get('itemsincart/{id}', 'BookController@getCartItemCount');
                // insert or update all order info given by user
                Route::post('orderinfo/{id}', 'Users\UserController@updateUser');
                // place an order
                Route::post('order', 'OrderController@insertOrder');   
                // clears the cart once the user lands on the invoice page
                Route::post('clearcart', 'OrderController@clearCart');
                // gets order info for a specific order
                Route::get('invoice', 'OrderController@getInvoiceInfo');          
                });
        });
// Below mention routes are admin. Non-admin users have no access.
    Route::prefix('admin')->group(function () {
        // Get all book categories
        Route::get('categories', 'BookController@allCategories');
        // Get all publishers
        Route::get('publishers', 'BookController@allPublishers');
        // Get all states
        Route::get('states', 'BookController@allStates');
        // Create a new book
        Route::post('newproduct', 'BookController@addProduct');
        // Create a new publisher
        Route::post('newpublisher', 'BookController@createPublisher');
        // Create a new product category
        Route::post('newcategory', 'BookController@createCategory');
        // Removes a product
        Route::post('removeproduct/{id}', 'BookController@removeProduct');
        // Updates a product
        Route::put('updateproduct/{id}', 'BookController@updateProduct');
        // Gets all data needed for admin panel
        Route::get('all', 'BookController@allAdmin');
            Route::prefix('reports')->group(function () {
               Route::get('ordersummary', 'OrderController@orderSummary');
               Route::get('customersbystate', 'Users\UserController@customersByState'); 
               Route::get('inventorybycategory', 'BookController@inventoryByCategory'); 
            });
    });
});
