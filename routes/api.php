<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->group(function () {
// 	
// });

//表單
Route::get('getResData','Api\ReservationController@index');
Route::post('resStore','Api\ReservationController@store');

Route::get('getContactData','Api\ContactController@index');
Route::post('contactStore','Api\ContactController@store');

Route::get('getSatiData','Api\SatisfactionController@index');
Route::post('satiStore','Api\SatisfactionController@store');

//account
Route::post('accountStore','Api\AccountController@store');