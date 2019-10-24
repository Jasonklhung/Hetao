<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Organization;
use App\WorkCase;
use App\User;
use App\Department;

use GuzzleHttp\Client;

class AssistantController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.StrokeManage.assistant.index',compact('organization'));
    }

    public function create(Organization $organization)
    {
    	return view('ht.StrokeManage.assistant.create',compact('organization'));
    }

    public function store(Organization $organization,Request $request)
    {
    	//to datebase
    	$type = '';

    	$case = new WorkCase;
    	$case->user_id = Auth::user()->id;
    	$case->department_id = Auth::user()->department->id;
    	$case->online = $request->online;
    	$case->urgent = $request->urgent;
    	foreach ($request->type as $key) {
    		$type .= $key.',';
    	}
    	$case->type = $type;
    	$case->cusKey = $request->cusKey;
    	$case->address = $request->address;
    	$case->mobile = $request->mobile;
    	$case->reason = $request->reason;
    	$case->datetime = $request->datetime;
    	$case->remarks = $request->remarks;
    	$case->save();

    	//api
    	$client = new \GuzzleHttp\Client();
    	$response = $client->post('http://60.251.216.90:8855/api_/reservation', [
    		'headers' => ['Content-Type' => 'application/json'],
    		'body' => json_encode([
    			'name' => Auth::user()->id,
    			'CUSTKEY' => $request->cusKey,
    			'type'=> $request->online,
    			'mobile' => $request->mobile,
    			'work_type' => $type,
    			'time' => $request->datetime,
    			'Urgent' => $request->urgent,
    			'remarks' => $request->remarks,
    			'address' => $request->address,
    			'DEPT' =>  Auth::user()->department->name
    		])
    	]);

    	$response = $response->getBody()->getContents();

    	return redirect()->route('ht.StrokeManage.assistant.index',compact('organization'))->with('success','新增成功');
    }

    public function edit(Organization $organization)
    {
    	return view('ht.StrokeManage.assistant.edit',compact('organization'));
    }

    public function show(Organization $organization)
    {
    	return view('ht.StrokeManage.assistant.show',compact('organization'));
    }

    public function getData(Organization $organization,Request $request)
    {

    	$client = new \GuzzleHttp\Client();
    	$response = $client->post('http://60.251.216.90:8855/api_/schedule', [
    		'headers' => ['Content-Type' => 'application/json'],
    		'body' => json_encode([
    			'token' => $request->token,
    			'DEPT' => $request->DEPT
    		])
    	]);

    	$response = $response->getBody()->getContents();

    	return $response;
    }

    public function getSupervisor(Organization $organization)
    {
    	$data = User::where('organization_id',Auth::user()->organization_id)->where('department_id',Auth::user()->department_id)->where('job','主管')->get();

    	return $data;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {
        //dd($request->all());

    	$dept = User::where('token',$request->owner_boss)->get();

    	$dept_id = $dept[0]['department_id'];

    	$dept_name = Department::where('id',$dept_id)->get();

    	$dept_name = $dept_name[0]['name']; //取得部門名稱

    	//api
    	$client = new \GuzzleHttp\Client();
    	$response = $client->post('http://60.251.216.90:8855/api_/assign-case-boss', [
    		'headers' => ['Content-Type' => 'application/json'],
    		'body' => json_encode([
    			'id' => $request->id,
    			'name' => $request->name,
    			'mobile'=> $request->mobile,
    			'GUI_number' => $request->GUI_number,
    			'address' => $request->address,
    			'work_type' => $request->work_type,
    			'time' => $request->time,
    			'owner_boss' => 'Z8564d5737a4ba80b8e7921e882e506ea',//$request->remarks,
    			'DEPT' => 'H026',//$dept_name,
    		])
    	]);

    	$response = $response->getBody()->getContents();

        return $response;
    }

    public function updateStatus(Organization $organization,Request $request)
    {
        //dd($request->all());

        //api
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->token,
                'id' => $request->id,
                'status'=> $request->status,
                'DEPT' => $request->DEPT
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

}

