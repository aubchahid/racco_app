<?php

use App\Http\Controllers\API\ClientController;
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
| Client client
|--------------------------------------------------------------------------
|
|*/



Route::get('/getClients', 'App\Http\Controllers\API\ClientController@getClients');
// Route::get('/getClientThecnicien/{id}', 'App\Http\Controllers\API\ClientController@getClientThecnicien');
Route::get('/getClientsThecnicien/{id}', [ClientController::class,'getClientsThecnicien']);

/*
|
*/
/*
|--------------------------------------------------------------------------
| Client blocage
|--------------------------------------------------------------------------
|
|*/



Route::post('/declarationBlocage', 'App\Http\Controllers\API\BlocageController@declarationBlocage');
Route::post('/storeImageBlocage', 'App\Http\Controllers\API\BlocagePictureController@storeImageBlocage');
// Route::get('/getClientThecnicien/{id}', 'App\Http\Controllers\API\ClientController@getClientThecnicien');


/*
|
*/


Route::get('/getAffectation', 'App\Http\Controllers\API\AffectationController@getAffectation');
Route::post('/createAffectation', 'App\Http\Controllers\API\AffectationController@createAffectation');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
