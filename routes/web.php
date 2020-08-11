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
Route::get('/HT/logout','HT\Auth\LoginController@logout')->name('ht.Auth.logout');
Route::post('/HT/getUUID','HT\Auth\LoginController@getUUID')->name('ht.Auth.getUUID');

//richmenu 派工單
Route::get('/HT/assignCase','HT\Auth\LoginController@assignCase')->name('ht.Auth.assignCase');
Route::get('/HT/getAssignCase','HT\Auth\LoginController@getAssignCase')->name('ht.Auth.getAssignCase');

//richmenu 行程回報
Route::get('/HT/report','HT\Auth\LoginController@report')->name('ht.Auth.report');
Route::get('/HT/getReport','HT\Auth\LoginController@getReport')->name('ht.Auth.getReport');

//richmenu 行程總覽
Route::get('/HT/overview','HT\Auth\LoginController@overview')->name('ht.Auth.overview');
Route::get('/HT/getOverview','HT\Auth\LoginController@getOverview')->name('ht.Auth.getOverview');

//通知設定
Route::get('/HT/noticePage','HT\Auth\LoginController@noticePage')->name('ht.Auth.noticePage');
Route::get('/HT/getNoticePage','HT\Auth\LoginController@getNoticePage')->name('ht.Auth.getNoticePage');

//跳轉頁中心
Route::get('/HT/redirectRoute','HT\Auth\LoginController@redirectRoute')->name('ht.Auth.redirectRoute');

Route::group(['middleware' => ['auth']], function () {

	Route::middleware(['check.organization'])->group(function (){
		//總覽
		Route::get('/HT/{organization}/Overview/index','HT\Overview\OverviewController@index')->name('ht.Overview.index');
		Route::post('/HT/{organization}/Overview/store','HT\Overview\OverviewController@store')->name('ht.Overview.store');
		Route::get('/HT/{organization}/Overview/show','HT\Overview\OverviewController@show')->name('ht.Overview.show');
		Route::post('/HT/{organization}/Overview/updateDel','HT\Overview\OverviewController@updateDel')->name('ht.Overview.updateDel');
		Route::get('/HT/{organization}/Overview/getData','HT\Overview\OverviewController@getData')->name('ht.Overview.getData');
		Route::get('/HT/{organization}/Overview/getAllData','HT\Overview\OverviewController@getAllData')->name('ht.Overview.getAllData');
		Route::get('/HT/{organization}/Overview/getCompany','HT\Overview\OverviewController@getCompany')->name('ht.Overview.getCompany');
		Route::post('/HT/{organization}/Overview/getName','HT\Overview\OverviewController@getName')->name('ht.Overview.getName');
		Route::post('/HT/{organization}/Overview/search','HT\Overview\OverviewController@search')->name('ht.Overview.search');
		Route::post('/HT/{organization}/Overview/searchAct','HT\Overview\OverviewController@searchAct')->name('ht.Overview.searchAct');
		Route::get('/HT/{organization}/Overview/showAll','HT\Overview\OverviewController@showAll')->name('ht.Overview.showAll');
		Route::post('/HT/{organization}/Overview/searchAll','HT\Overview\OverviewController@searchAll')->name('ht.Overview.searchAll');

		//總攬-通知設定
		Route::get('/HT/{organization}/Overview/notice/index','HT\Overview\NoticeController@index')->name('ht.Overview.notice.index');
		Route::post('/HT/{organization}/Overview/notice/getUserName','HT\Overview\NoticeController@getUserName')->name('ht.Overview.notice.getUserName');
		Route::post('/HT/{organization}/Overview/notice/store','HT\Overview\NoticeController@store')->name('ht.Overview.notice.store');
		Route::post('/HT/{organization}/Overview/notice/getNotice','HT\Overview\NoticeController@getNotice')->name('ht.Overview.notice.getNotice');
		Route::post('/HT/{organization}/Overview/notice/edit','HT\Overview\NoticeController@edit')->name('ht.Overview.notice.edit');
		Route::post('/HT/{organization}/Overview/notice/noticeSearch','HT\Overview\NoticeController@noticeSearch')->name('ht.Overview.notice.noticeSearch');

		//週期循環-個人
		Route::get('/HT/{organization}/Cycle/self/index','HT\Cycle\SelfController@index')->name('ht.Cycle.self.index');
		Route::post('/HT/{organization}/Cycle/self/changeDate','HT\Cycle\SelfController@changeDate')->name('ht.Cycle.self.changeDate');
		Route::post('/HT/{organization}/Cycle/self/cycleFinish','HT\Cycle\SelfController@cycleFinish')->name('ht.Cycle.self.cycleFinish');
		Route::post('/HT/{organization}/Cycle/self/cycleTurn','HT\Cycle\SelfController@cycleTurn')->name('ht.Cycle.self.cycleTurn');
		Route::post('/HT/{organization}/Cycle/self/cycleReportSearch','HT\Cycle\SelfController@cycleReportSearch')->name('ht.Cycle.self.cycleReportSearch');
		Route::post('/HT/{organization}/Cycle/self/thisDateChange','HT\Cycle\SelfController@thisDateChange')->name('ht.Cycle.self.thisDateChange');
		Route::post('/HT/{organization}/Cycle/self/cycleNowSearch','HT\Cycle\SelfController@cycleNowSearch')->name('ht.Cycle.self.cycleNowSearch');
		Route::post('/HT/{organization}/Cycle/self/cycleNotice','HT\Cycle\SelfController@cycleNotice')->name('ht.Cycle.self.cycleNotice');

		//週期循環-全站
		Route::get('/HT/{organization}/Cycle/all/index','HT\Cycle\AllController@index')->name('ht.Cycle.all.index');
		Route::post('/HT/{organization}/Cycle/all/cycleAssign','HT\Cycle\AllController@cycleAssign')->name('ht.Cycle.all.cycleAssign');
		Route::post('/HT/{organization}/Cycle/all/cycleReady','HT\Cycle\AllController@cycleReady')->name('ht.Cycle.all.cycleReady');
		Route::post('/HT/{organization}/Cycle/all/cycleTurn','HT\Cycle\AllController@cycleTurn')->name('ht.Cycle.all.cycleTurn');
		Route::post('/HT/{organization}/Cycle/all/cycleSearch','HT\Cycle\AllController@cycleSearch')->name('ht.Cycle.all.cycleSearch');
		Route::post('/HT/{organization}/Cycle/all/assignCardSearch','HT\Cycle\AllController@assignCardSearch')->name('ht.Cycle.all.assignCardSearch');
		Route::post('/HT/{organization}/Cycle/all/turnCardSearch','HT\Cycle\AllController@turnCardSearch')->name('ht.Cycle.all.turnCardSearch');

		//週期循環-進度
		Route::get('/HT/{organization}/Cycle/now/index','HT\Cycle\NowController@index')->name('ht.Cycle.now.index');
		Route::post('/HT/{organization}/Cycle/now/staffNowSearch','HT\Cycle\NowController@staffNowSearch')->name('ht.Cycle.now.staffNowSearch');
		Route::post('/HT/{organization}/Cycle/now/dashSearch','HT\Cycle\NowController@dashSearch')->name('ht.Cycle.now.dashSearch');

		//領退料管理-領料申請
		Route::get('/HT/{organization}/Material/material/index','HT\Material\MaterialController@index')->name('ht.Material.material.index');
		Route::get('/HT/{organization}/Material/material/materialsNumberSearch','HT\Material\MaterialController@materialsNumberSearch')->name('ht.Material.material.materialsNumberSearch');
		Route::get('/HT/{organization}/Material/material/machineNumberSearch','HT\Material\MaterialController@machineNumberSearch')->name('ht.Material.material.machineNumberSearch');
		Route::post('/HT/{organization}/Material/material/store','HT\Material\MaterialController@store')->name('ht.Material.material.store');
		Route::post('/HT/{organization}/Material/material/storeBack','HT\Material\MaterialController@storeBack')->name('ht.Material.material.storeBack');
		Route::post('/HT/{organization}/Material/material/notGetMaterialSearch','HT\Material\MaterialController@notGetMaterialSearch')->name('ht.Material.material.notGetMaterialSearch');
		Route::post('/HT/{organization}/Material/material/getMaterialSearch','HT\Material\MaterialController@getMaterialSearch')->name('ht.Material.material.getMaterialSearch');

		//領退料管理-料單管理
		Route::get('/HT/{organization}/Material/case/index','HT\Material\CaseController@index')->name('ht.Material.case.index');
		Route::post('/HT/{organization}/Material/case/material_edit','HT\Material\CaseController@material_edit')->name('ht.Material.case.material_edit');
		Route::post('/HT/{organization}/Material/case/material_confirm','HT\Material\CaseController@material_confirm')->name('ht.Material.case.material_confirm');
		Route::post('/HT/{organization}/Material/case/material_download','HT\Material\CaseController@material_download')->name('ht.Material.case.material_download');
		Route::post('/HT/{organization}/Material/case/materialBackEdit','HT\Material\CaseController@materialBackEdit')->name('ht.Material.case.materialBackEdit');
		Route::post('/HT/{organization}/Material/case/materialBackConfirm','HT\Material\CaseController@materialBackConfirm')->name('ht.Material.case.materialBackConfirm');
		Route::post('/HT/{organization}/Material/case/materialBackDownload','HT\Material\CaseController@materialBackDownload')->name('ht.Material.case.materialBackDownload');
		Route::post('/HT/{organization}/Material/case/materialingSearch','HT\Material\CaseController@materialingSearch')->name('ht.Material.case.materialingSearch');
		Route::post('/HT/{organization}/Material/case/materialFinishSearch','HT\Material\CaseController@materialFinishSearch')->name('ht.Material.case.materialFinishSearch');
		Route::post('/HT/{organization}/Material/case/materialBackSearch','HT\Material\CaseController@materialBackSearch')->name('ht.Material.case.materialBackSearch');
		Route::post('/HT/{organization}/Material/case/materialBackFinishSearch','HT\Material\CaseController@materialBackFinishSearch')->name('ht.Material.case.materialBackFinishSearch');

		//領退料管理-庫存管理
		Route::get('/HT/{organization}/Material/stock/index','HT\Material\StockController@index')->name('ht.Material.stock.index');
		Route::get('/HT/{organization}/Material/stock/stockApi','HT\Material\StockController@stockApi')->name('ht.Material.stock.stockApi');

		//客戶資料查詢
		Route::get('/HT/{organization}/Customer/index','HT\Customer\CustomerController@index')->name('ht.Customer.index');
		Route::get('/HT/{organization}/Customer/show/{id}','HT\Customer\CustomerController@show')->name('ht.Customer.show');
		Route::post('/HT/{organization}/Customer/search','HT\Customer\CustomerController@search')->name('ht.Customer.search');
		Route::post('/HT/{organization}/Customer/show/tradeSearch','HT\Customer\CustomerController@tradeSearch')->name('ht.Customer.show.tradeSearch');
		Route::post('/HT/{organization}/Customer/show/arapSearch','HT\Customer\CustomerController@arapSearch')->name('ht.Customer.show.arapSearch');
		Route::post('/HT/{organization}/Customer/show/cycleSearch','HT\Customer\CustomerController@cycleSearch')->name('ht.Customer.show.cycleSearch');

		//業務管理-個人業務
		Route::get('/HT/{organization}/Business/self/index','HT\Business\SelfController@index')->name('ht.Business.self.index');
		Route::get('/HT/{organization}/Business/self/index2','HT\Business\SelfController@index2')->name('ht.Business.self.index2');
		Route::get('/HT/{organization}/Business/self/create','HT\Business\SelfController@create')->name('ht.Business.self.create');
		Route::post('/HT/{organization}/Business/self/store','HT\Business\SelfController@store')->name('ht.Business.self.store');
		Route::post('/HT/{organization}/Business/self/update/{id}','HT\Business\SelfController@update')->name('ht.Business.self.update');
		Route::get('/HT/{organization}/Business/self/visitEdit/{id}','HT\Business\SelfController@visitEdit')->name('ht.Business.self.visitEdit');
		Route::get('/HT/{organization}/Business/self/trackEdit/{id}','HT\Business\SelfController@trackEdit')->name('ht.Business.self.trackEdit');
		Route::post('/HT/{organization}/Business/self/trackUpdate/{id}','HT\Business\SelfController@trackUpdate')->name('ht.Business.self.trackUpdate');
		Route::post('/HT/{organization}/Business/self/businessVisitChangeStatus','HT\Business\SelfController@businessVisitChangeStatus')->name('ht.Business.self.businessVisitChangeStatus');
		Route::post('/HT/{organization}/Business/self/businessTrackChangeStatus','HT\Business\SelfController@businessTrackChangeStatus')->name('ht.Business.self.businessTrackChangeStatus');
		Route::post('/HT/{organization}/Business/self/sendMail','HT\Business\SelfController@sendMail')->name('ht.Business.self.sendMail');
		Route::post('/HT/{organization}/Business/self/trackExcel','HT\Business\SelfController@trackExcel')->name('ht.Business.self.trackExcel');
		Route::post('/HT/{organization}/Business/self/trackWord','HT\Business\SelfController@trackWord')->name('ht.Business.self.trackWord');
		Route::post('/HT/{organization}/Business/self/visitSearch','HT\Business\SelfController@visitSearch')->name('ht.Business.self.visitSearch');
		Route::post('/HT/{organization}/Business/self/trackSearch','HT\Business\SelfController@trackSearch')->name('ht.Business.self.trackSearch');
		Route::post('/HT/{organization}/Business/self/monthSearch','HT\Business\SelfController@monthSearch')->name('ht.Business.self.monthSearch');
		Route::post('/HT/{organization}/Business/self/addNotice','HT\Business\SelfController@addNotice')->name('ht.Business.self.addNotice');
		Route::post('/HT/{organization}/Business/self/downloadfile','HT\Business\SelfController@downloadfile')->name('ht.Business.self.downloadfile');

		//業務管理-全站業務
		Route::get('/HT/{organization}/Business/all/index','HT\Business\AllController@index')->name('ht.Business.all.index');
		Route::get('/HT/{organization}/Business/all/show/{id}','HT\Business\AllController@show')->name('ht.Business.all.show');
		Route::post('/HT/{organization}/Business/all/visitSearch','HT\Business\AllController@visitSearch')->name('ht.Business.all.visitSearch');
		Route::post('/HT/{organization}/Business/all/trackSearch','HT\Business\AllController@trackSearch')->name('ht.Business.all.trackSearch');
		Route::post('/HT/{organization}/Business/all/monthSearch','HT\Business\AllController@monthSearch')->name('ht.Business.all.monthSearch');
		Route::post('/HT/{organization}/Business/all/numberSearch','HT\Business\AllController@numberSearch')->name('ht.Business.all.numberSearch');

		//業績查詢-個人業績
		Route::get('/HT/{organization}/Performance/self/index','HT\Performance\SelfController@index')->name('ht.Performance.self.index');
		Route::post('/HT/{organization}/Performance/self/performanceSearch','HT\Performance\SelfController@performanceSearch')->name('ht.Performance.self.performanceSearch');
		Route::post('/HT/{organization}/Performance/self/categorySearch','HT\Performance\SelfController@categorySearch')->name('ht.Performance.self.categorySearch');

		//業績查詢-全站業績
		Route::get('/HT/{organization}/Performance/all/index','HT\Performance\AllController@index')->name('ht.Performance.all.index');
		Route::post('/HT/{organization}/Performance/all/performanceAllSearch','HT\Performance\AllController@performanceAllSearch')->name('ht.Performance.all.performanceAllSearch');
		Route::post('/HT/{organization}/Performance/all/businessSearch','HT\Performance\AllController@businessSearch')->name('ht.Performance.all.businessSearch');

		//行程管理-助理
		Route::get('/HT/{organization}/StrokeManage/assistant/index','HT\StrokeManage\AssistantController@index')->name('ht.StrokeManage.assistant.index');

		Route::get('/HT/{organization}/StrokeManage/assistant/index2','HT\StrokeManage\AssistantController@index2')->name('ht.StrokeManage.assistant.index2');

		Route::get('/HT/{organization}/StrokeManage/assistant/index3','HT\StrokeManage\AssistantController@index3')->name('ht.StrokeManage.assistant.index3');

		Route::get('/HT/{organization}/StrokeManage/assistant/create','HT\StrokeManage\AssistantController@create')->name('ht.StrokeManage.assistant.create');

		Route::post('/HT/{organization}/StrokeManage/assistant/store','HT\StrokeManage\AssistantController@store')->name('ht.StrokeManage.assistant.store');

		Route::get('/HT/{organization}/StrokeManage/assistant/show/{id}','HT\StrokeManage\AssistantController@show')->name('ht.StrokeManage.assistant.show');

		Route::post('/HT/{organization}/StrokeManage/assistant/resSearch','HT\StrokeManage\AssistantController@resSearch')->name('ht.StrokeManage.assistant.resSearch');

		Route::get('/HT/{organization}/StrokeManage/assistant/edit/{id}','HT\StrokeManage\AssistantController@edit')->name('ht.StrokeManage.assistant.edit');

		Route::post('/HT/{organization}/StrokeManage/assistant/update','HT\StrokeManage\AssistantController@update')->name('ht.StrokeManage.assistant.update');

		Route::get('/HT/{organization}/StrokeManage/assistant/schedule','HT\StrokeManage\AssistantController@schedule')->name('ht.StrokeManage.assistant.schedule');

		Route::get('/HT/{organization}/StrokeManage/assistant/getData','HT\StrokeManage\AssistantController@getData')->name('ht.StrokeManage.assistant.getData');

		Route::get('/HT/{organization}/StrokeManage/assistant/getSupervisor','HT\StrokeManage\AssistantController@getSupervisor')->name('ht.StrokeManage.assistant.getSupervisor');

		Route::post('/HT/{organization}/StrokeManage/assistant/assignCaseBoss','HT\StrokeManage\AssistantController@assignCaseBoss')->name('ht.StrokeManage.assistant.assignCaseBoss');

		Route::post('/HT/{organization}/StrokeManage/assistant/updateStatus','HT\StrokeManage\AssistantController@updateStatus')->name('ht.StrokeManage.assistant.updateStatus');

		Route::post('/HT/{organization}/StrokeManage/assistant/transfer','HT\StrokeManage\AssistantController@transfer')->name('ht.StrokeManage.assistant.transfer');

		Route::post('/HT/{organization}/StrokeManage/assistant/caseSearch','HT\StrokeManage\AssistantController@caseSearch')->name('ht.StrokeManage.assistant.caseSearch');


		//行程管理-主管
		Route::get('/HT/{organization}/StrokeManage/supervisor/index','HT\StrokeManage\SupervisorController@index')->name('ht.StrokeManage.supervisor.index');

		Route::get('/HT/{organization}/StrokeManage/supervisor/show/{id}','HT\StrokeManage\SupervisorController@show')->name('ht.StrokeManage.supervisor.show');

		Route::get('/HT/{organization}/StrokeManage/supervisor/index3','HT\StrokeManage\SupervisorController@index3')->name('ht.StrokeManage.supervisor.index3');

		Route::get('/HT/{organization}/StrokeManage/supervisor/getData','HT\StrokeManage\SupervisorController@getData')->name('ht.StrokeManage.supervisor.getData');

		Route::get('/HT/{organization}/StrokeManage/supervisor/schedule','HT\StrokeManage\SupervisorController@schedule')->name('ht.StrokeManage.supervisor.schedule');

		Route::get('/HT/{organization}/StrokeManage/supervisor/getAssign','HT\StrokeManage\SupervisorController@getAssign')->name('ht.StrokeManage.supervisor.getAssign');

		Route::post('/HT/{organization}/StrokeManage/supervisor/assignCaseBoss','HT\StrokeManage\SupervisorController@assignCaseBoss')->name('ht.StrokeManage.supervisor.assignCaseBoss');

		Route::post('/HT/{organization}/StrokeManage/supervisor/updateStatus','HT\StrokeManage\SupervisorController@updateStatus')->name('ht.StrokeManage.supervisor.updateStatus');

		Route::post('/HT/{organization}/StrokeManage/supervisor/transfer','HT\StrokeManage\SupervisorController@transfer')->name('ht.StrokeManage.supervisor.transfer');

		Route::post('/HT/{organization}/StrokeManage/supervisor/assignCase','HT\StrokeManage\SupervisorController@assignCase')->name('ht.StrokeManage.supervisor.assignCase');

		Route::post('/HT/{organization}/StrokeManage/supervisor/searchStatus','HT\StrokeManage\SupervisorController@searchStatus')->name('ht.StrokeManage.supervisor.searchStatus');

		Route::post('/HT/{organization}/StrokeManage/supervisor/searchAssign','HT\StrokeManage\SupervisorController@searchAssign')->name('ht.StrokeManage.supervisor.searchAssign');

		Route::post('/HT/{organization}/StrokeManage/supervisor/assignOwner','HT\StrokeManage\SupervisorController@assignOwner')->name('ht.StrokeManage.supervisor.assignOwner');

		Route::post('/HT/{organization}/StrokeManage/supervisor/assignOwnerAgain','HT\StrokeManage\SupervisorController@assignOwnerAgain')->name('ht.StrokeManage.supervisor.assignOwnerAgain');

		Route::post('/HT/{organization}/StrokeManage/supervisor/onlineSearch','HT\StrokeManage\SupervisorController@onlineSearch')->name('ht.StrokeManage.supervisor.onlineSearch');

		Route::post('/HT/{organization}/StrokeManage/supervisor/notAssignSearch','HT\StrokeManage\SupervisorController@notAssignSearch')->name('ht.StrokeManage.supervisor.notAssignSearch');

		Route::post('/HT/{organization}/StrokeManage/supervisor/assignCaseSearch','HT\StrokeManage\SupervisorController@assignCaseSearch')->name('ht.StrokeManage.supervisor.assignCaseSearch');


		//行程管理-員工
		Route::get('/HT/{organization}/StrokeManage/staff/index','HT\StrokeManage\StaffController@index')->name('ht.StrokeManage.staff.index');

		Route::get('/HT/{organization}/StrokeManage/staff/getData','HT\StrokeManage\StaffController@getData')->name('ht.StrokeManage.staff.getData');

		Route::post('/HT/{organization}/StrokeManage/staff/updateStatus','HT\StrokeManage\StaffController@updateStatus')->name('ht.StrokeManage.staff.updateStatus');

		Route::post('/HT/{organization}/StrokeManage/staff/transfer','HT\StrokeManage\StaffController@transfer')->name('ht.StrokeManage.staff.transfer');

		Route::post('/HT/{organization}/StrokeManage/staff/updateCaseStatus','HT\StrokeManage\StaffController@updateCaseStatus')->name('ht.StrokeManage.staff.updateCaseStatus');

		Route::post('/HT/{organization}/StrokeManage/staff/reportAssignSearch','HT\StrokeManage\StaffController@reportAssignSearch')->name('ht.StrokeManage.staff.reportAssignSearch');

		Route::post('/HT/{organization}/StrokeManage/staff/assignCaseSearch','HT\StrokeManage\StaffController@assignCaseSearch')->name('ht.StrokeManage.staff.assignCaseSearch');


		//表單設定-線上預約
		Route::get('/HT/{organization}/Form/reservation/index','HT\Form\ReservationController@index')->name('ht.Form.reservation.index');

		Route::post('/HT/{organization}/Form/reservation/store','HT\Form\ReservationController@store')->name('ht.Form.reservation.store');

		//表單設定-滿意度調查
		Route::get('/HT/{organization}/Form/satisfaction/index','HT\Form\SatisfactionController@index')->name('ht.Form.satisfaction.index');

		Route::post('/HT/{organization}/Form/satisfaction/store','HT\Form\SatisfactionController@store')->name('ht.Form.satisfaction.store');

		//表單設定-與我聯繫
		Route::get('/HT/{organization}/Form/contact/index','HT\Form\ContactController@index')->name('ht.Form.contact.index');

		Route::post('/HT/{organization}/Form/contact/store','HT\Form\ContactController@store')->name('ht.Form.contact.store');

		//推播時間設定
		Route::get('/HT/{organization}/Timeset/index','HT\Timeset\TimesetController@index')->name('ht.Timeset.index');

		Route::post('/HT/{organization}/Timeset/store','HT\Timeset\TimesetController@store')->name('ht.Timeset.store');

		//權限管理
		Route::get('/HT/{organization}/Permission/index','HT\Permission\PermissionController@index')->name('ht.Permission.index');

		Route::get('/HT/{organization}/Permission/create','HT\Permission\PermissionController@create')->name('ht.Permission.create');

		Route::post('/HT/{organization}/Permission/getCompany','HT\Permission\PermissionController@getCompany')->name('ht.Permission.getCompany');

		Route::post('/HT/{organization}/Permission/store','HT\Permission\PermissionController@store')->name('ht.Permission.store');

		Route::get('/HT/{organization}/Permission/edit/{id}','HT\Permission\PermissionController@edit')->name('ht.Permission.edit');

		Route::post('/HT/{organization}/Permission/update','HT\Permission\PermissionController@update')->name('ht.Permission.update');

		Route::get('/HT/{organization}/Permission/getUserInfo','HT\Permission\PermissionController@getUserInfo')->name('ht.Permission.getUserInfo');

		Route::post('/HT/{organization}/Permission/createOrg','HT\Permission\PermissionController@createOrg')->name('ht.Permission.createOrg');

		Route::post('/HT/{organization}/Permission/searchUser','HT\Permission\PermissionController@searchUser')->name('ht.Permission.searchUser');

		Route::delete('/HT/{organization}/Permission/destroy','HT\Permission\PermissionController@destroy')->name('ht.Permission.destroy');

		//與我聯繫/滿意度調查表單內容

		//與我聯繫
		Route::get('/HT/{organization}/FormDetails/ContactUs/index','HT\FormDetails\ContactUsController@index')->name('ht.FormDetails.ContactUs.index');

		Route::get('/HT/{organization}/FormDetails/ContactUs/show/{id}','HT\FormDetails\ContactUsController@show')->name('ht.FormDetails.ContactUs.show');

		Route::post('/HT/{organization}/FormDetails/ContactUs/contactSearch','HT\FormDetails\ContactUsController@contactSearch')->name('ht.FormDetails.ContactUs.contactSearch');

		//滿意度調查
		Route::get('/HT/{organization}/FormDetails/satisfactionSurvey/index','HT\FormDetails\satisfactionSurveyController@index')->name('ht.FormDetails.satisfactionSurvey.index');

		Route::get('/HT/{organization}/FormDetails/satisfactionSurvey/show/{id}','HT\FormDetails\satisfactionSurveyController@show')->name('ht.FormDetails.satisfactionSurvey.show');
		
		Route::post('/HT/{organization}/FormDetails/satisfactionSurvey/satisfactionSearch','HT\FormDetails\satisfactionSurveyController@satisfactionSearch')->name('ht.FormDetails.satisfactionSurvey.satisfactionSearch');
	});
});