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
Route::post('reservation','Api\ReservationController@show');
Route::post('statusUpdate','Api\ReservationController@update');

Route::get('getContactData','Api\ContactController@index');
Route::post('contactStore','Api\ContactController@store');
Route::post('contact','Api\ContactController@show');

Route::get('getSatiData','Api\SatisfactionController@index');
Route::post('satiStore','Api\SatisfactionController@store');
Route::post('satisfaction','Api\SatisfactionController@show');

//account
Route::post('accountStore','Api\AccountController@store');

//material
Route::post('get_material_detail','Api\MaterialController@get_material_detail');
Route::post('get_material','Api\MaterialController@get_material');



//crontab
Route::get('reservationFinish','Api\CrontabController@reservationFinish');
Route::get('reservationPreviousDay','Api\CrontabController@reservationPreviousDay');
Route::get('satisfactionPush','Api\CrontabController@satisfactionPush');
Route::get('supervisorAssign','Api\CrontabController@supervisorAssign');
Route::get('activitiesPush','Api\CrontabController@activitiesPush');