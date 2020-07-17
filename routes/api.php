<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/resto', 'RestaurantController@store');
    Route::post('/resto/menu-items', 'MenuController@getRestoMenu');
    // Route::post('/menu-items', 'MenuController@getRestoMenu');
    Route::post('/order/save', 'RestaurantOrderController@store');
    Route::post('/order/complete', 'RestaurantOrderController@complete');
    Route::post('/order/remove', 'RestaurantOrderController@remove');
});
// Route::post('/item/save', 'MenuController@saveMenuItem');
Route::post('/item', 'MenuController@addMenuItem');
