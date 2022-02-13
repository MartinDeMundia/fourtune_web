<?php

use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
    Route::post('/login', 'LoginController');
    Route::post('/register', 'RegisterController');
    Route::post('/logout', 'LogoutController')->middleware('auth:api');
    Route::post('/password-forgot', 'ForgotPasswordController');
    Route::post('/password-reset', 'ResetPasswordController');
});

JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
    $api->get('me', 'Api\V1\MeController@readProfile');
    $api->patch('me', 'Api\V1\MeController@updateProfile');

    $api->resource('users');
});

JsonApi::register('v1')->routes(function ($api) {
    $api->post('token-purchases', 'Api\V1\TokenPurchasesController@getTokenPurchases');
    $api->post('coins-earned-backend', 'Api\V1\CoinsEarnedController@getCoinsEarned');
    $api->post('set-fourtune-token', 'Api\V1\TokenPurchasesController@setFourtuneToken');
    $api->post('get-fourtune-token', 'Api\V1\TokenPurchasesController@getFourtuneTokenPrice');
    $api->post('delete-fourtune-token', 'Api\V1\TokenPurchasesController@deleteFourtuneTokenPrice');
    $api->post('get-users', 'Api\V1\UserController@getUsers');
    $api->post('get-fourtune-transfer', 'Api\V1\TokenPurchasesController@getFourtuneTransfer');
    $api->post('dashboard-data', 'Api\V1\DashBoardController@getDashBoardData');
    $api->post('dashboard-activeusers', 'Api\V1\DashBoardController@getActiveUsers');
    $api->post('get-events', 'Api\V1\EventsController@getEvents');
    $api->post('delete-fourtune-event', 'Api\V1\EventsController@deleteFourtuneEvent');
    

});

/*JsonApi::register('v1')->routes(function ($api) {
    $api->post('coins-earned', 'Api\V1\CoinsEarnedController@getCoinsEarned');
});
*/

Route::namespace('Api\V1')->prefix('api/v1')->middleware('json.api')->group(function () { 
    
    Route::get('debug', 'EventsController@getEvents');

    Route::post('/authenticate-user', 'UserController@authenticateUser');
    Route::post('/create-user', 'UserController@createUser'); 
    
    Route::post('/coins-earned', 'ServiceController@getCoinsEarned');
    Route::post('/purchase-token', 'ServiceController@purchaseToken');
    Route::post('/gamer-profile', 'ServiceController@gamerProfile');
    Route::post('/transfer-token', 'ServiceController@transferToken');
    Route::post('/post-earnings', 'ServiceController@postEarnings');

    //multipart data
    Route::post('/add-event', 'EventsController@addEvent');
    Route::post('/upload-event-images', 'EventsController@uploadImages');




    
});