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




/*
***************************
    AUTHENTICATION RESOURCES
***************************
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'Api\v1\Auth\LoginController@login');

    Route::post('/register', 'Api\v1\Auth\RegisterController@register');

    Route::middleware('auth:api-seller')
        ->get('/user', 'Api\v1\Auth\LoginController@getCurrentUser' );

    Route::middleware('auth:api-seller')
        ->get('/logout', 'Api\v1\Auth\LoginController@logout' );
});

// Route::post('/auth/login', 'Api\v1\Auth\LoginController@login');

// Route::post('/auth/register', 'Api\v1\Auth\RegisterController@register');

// Route::middleware('auth:api-seller')
//     ->get('/auth/user', 'Api\v1\Auth\LoginController@getCurrentUser' );

// Route::middleware('auth:api-seller')
//     ->get('/auth/logout', 'Api\v1\Auth\LoginController@logout' );


/*
***************************
    PRODUCT RESOURCES
***************************
*/

Route::middleware('auth:api-seller')
    ->get('/products', 'Api\v1\ProductController@index');

Route::middleware('auth:api-seller')
    ->get('/products/{id}', 'Api\v1\ProductController@show');

Route::middleware('auth:api-seller')
    ->get('/products/seller/{sid}', 'Api\v1\ProductController@getProductsBySeller');

Route::middleware('auth:api-seller')
    ->get('/products/{id}/seller/{sid}', 'Api\v1\ProductController@getSellerForProduct');

Route::middleware('auth:api-seller')
    ->post('/products', 'Api\v1\ProductController@store');






