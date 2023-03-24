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
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
|
|*/


Route::post('/loginApi', 'App\Http\Controllers\API\AuthController@loginApi');
Route::post('/registerApi', 'App\Http\Controllers\API\AuthController@registerpi');

/*
|
*/
/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
|
|*/


Route::post('/updateDeviseKey', 'App\Http\Controllers\API\UserController@updateDeviseKey');

/*
|
*/
/*
|
*/
/*
|--------------------------------------------------------------------------
| Client routes
|--------------------------------------------------------------------------
|
|*/



Route::get('/getClients', 'App\Http\Controllers\API\ClientController@getClients');

/*
|
*/


Route::get('/getAffectation', 'App\Http\Controllers\API\AffectationController@getAffectation');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
