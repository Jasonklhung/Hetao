<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

//login
Route::get('/HT/login','HT\Auth\LoginController@show')->name('ht.Auth.show');
Route::post('/HT/getUUID','HT\Auth\LoginController@getUUID')->name('ht.Auth.getUUID');


Route::group(['middleware' => ['auth']], function () {

	Route::middleware(['check.organization'])->group(function (){
		//總覽
		Route::get('/HT/{organization}/Overview/index','HT\Overview\OverviewController@index')->name('ht.Overview.index');
		Route::post('/HT/{organization}/Overview/store','HT\Overview\OverviewController@store')->name('ht.Overview.store');
		Route::get('/HT/{organization}/Overview/show','HT\Overview\OverviewController@show')->name('ht.Overview.show');
		Route::get('/HT/{organization}/Overview/getData','HT\Overview\OverviewController@getData')->name('ht.Overview.getData');

		//行程管理-助理
		Route::get('/HT/{organization}/StrokeManage/assistant/index','HT\StrokeManage\AssistantController@index')->name('ht.StrokeManage.assistant.index');

		Route::get('/HT/{organization}/StrokeManage/assistant/create','HT\StrokeManage\AssistantController@create')->name('ht.StrokeManage.assistant.create');

		Route::post('/HT/{organization}/StrokeManage/assistant/store','HT\StrokeManage\AssistantController@store')->name('ht.StrokeManage.assistant.store');

		Route::get('/HT/{organization}/StrokeManage/assistant/show','HT\StrokeManage\AssistantController@show')->name('ht.StrokeManage.assistant.show');

		Route::get('/HT/{organization}/StrokeManage/assistant/edit','HT\StrokeManage\AssistantController@edit')->name('ht.StrokeManage.assistant.edit');

		Route::post('/HT/{organization}/StrokeManage/assistant/update','HT\StrokeManage\AssistantController@update')->name('ht.StrokeManage.assistant.update');

		//行程管理-主管
		Route::get('/HT/{organization}/StrokeManage/supervisor/index','HT\StrokeManage\SupervisorController@index')->name('ht.StrokeManage.supervisor.index');

		Route::get('/HT/{organization}/StrokeManage/supervisor/show','HT\StrokeManage\SupervisorController@show')->name('ht.StrokeManage.supervisor.show');

		//行程管理-員工
		Route::get('/HT/{organization}/StrokeManage/staff/index','HT\StrokeManage\StaffController@index')->name('ht.StrokeManage.staff.index');

		//表單設定-線上預約
		Route::get('/HT/{organization}/Form/reservation/index','HT\Form\ReservationController@index')->name('ht.Form.reservation.index');

		//表單設定-滿意度調查
		Route::get('/HT/{organization}/Form/satisfaction/index','HT\Form\SatisfactionController@index')->name('ht.Form.satisfaction.index');

		//表單設定-與我聯繫
		Route::get('/HT/{organization}/Form/contact/index','HT\Form\ContactController@index')->name('ht.Form.contact.index');

		//推播時間設定
		Route::get('/HT/{organization}/Timeset/index','HT\Timeset\TimesetController@index')->name('ht.Timeset.index');

		//權限管理
		Route::get('/HT/{organization}/Permission/index','HT\Permission\PermissionController@index')->name('ht.Permission.index');

		Route::get('/HT/{organization}/Permission/create','HT\Permission\PermissionController@create')->name('ht.Permission.create');

		Route::post('/HT/{organization}/Permission/store','HT\Permission\PermissionController@store')->name('ht.Permission.store');

		Route::get('/HT/{organization}/Permission/edit','HT\Permission\PermissionController@edit')->name('ht.Permission.edit');

		Route::get('/HT/{organization}/Permission/update','HT\Permission\PermissionController@update')->name('ht.Permission.update');
	});
});