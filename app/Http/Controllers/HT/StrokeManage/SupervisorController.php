<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;

use App\User;
use App\Department;
use App\SupervisorCase;
use App\TransferCase;
use Auth;
use DB;

class SupervisorController extends Controller
{
    public function index(Organization $organization)
    {
    	$supervisor = SupervisorCase::where('user_id',Auth::user()->id)->get();

        $assign = User::where('organization_id',Auth::user()->organization_id)->get();

        $job = Auth::user()->job;
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->status == null || $v->owner == '' || $v->owner == 'F'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }else{
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->owner == null || $v->owner == ''){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

    	return view('ht.StrokeManage.supervisor.index',compact('organization','supervisor','caseCount','assign'));
    }

    public function index3(Organization $organization)
    {
        $supervisor = SupervisorCase::where('user_id',Auth::user()->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $countArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;

                foreach ($array as $k => $v) {
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

        return view('ht.StrokeManage.supervisor.index3',compact('organization','supervisor','caseCount'));
    }

    public function getData(Organization $organization,Request $request)
    {
    	$client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->token,
                'DEPT' => $request->DEPT
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function schedule(Organization $organization,Request $request)
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

    public function getAssign(Organization $organization)
    {
    	$data = User::where('organization_id',Auth::user()->organization_id)->get();

    	return $data;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {

    	$dept = User::where('token',$request->owner_boss)->get();

    	$dept_id = $dept[0]['department_id'];

    	$dept_name = Department::where('id',$dept_id)->get();

    	$dept_name = $dept_name[0]['name'];

    	//DB
        $supervisor = SupervisorCase::where('case_id',$request->id)->get();
        if($supervisor->isNotEmpty()){
            $supervisor = SupervisorCase::find($supervisor[0]['id']);
            $supervisor->user_id = Auth::user()->id;
            $supervisor->case_id = $request->id;
            $supervisor->cuskey = $request->name;
            $supervisor->mobile = $request->mobile;
            $supervisor->GUI_number = $request->GUI_number;
            $supervisor->address = $request->address;
            $supervisor->name = $request->case_name;
            $supervisor->reason = $request->reason;
            $supervisor->work_type = $request->work_type;
            $supervisor->time = $request->time;
            $supervisor->owner = $dept[0]['name'];
            $supervisor->status = '';
            $supervisor->save();
        }else{
            $supervisor = new SupervisorCase;
            $supervisor->user_id = Auth::user()->id;
            $supervisor->case_id = $request->id;
            $supervisor->cuskey = $request->name;
            $supervisor->mobile = $request->mobile;
            $supervisor->GUI_number = $request->GUI_number;
            $supervisor->name = $request->case_name;
            $supervisor->address = $request->address;
            $supervisor->reason = $request->reason;
            $supervisor->work_type = $request->work_type;
            $supervisor->time = $request->time;
            $supervisor->owner = $dept[0]['name'];
            $supervisor->status = $request->status;
            $supervisor->save();
        }

    	$case = TransferCase::where('case_id',$request->id)->get();

    	if($case->isNotEmpty()){
            DB::table('transfer_cases')
                ->where('case_id',$request->id)
                ->update(['user_id' => Auth::user()->id]);
        }else{
            $transfer = new TransferCase;
            $transfer->user_id = Auth::user()->id;
            $transfer->case_id = $request->id;
            $transfer->save();
        }


        //api update status
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->owner_boss,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => $dept_name
            ])
        ]);

    	//api
        if($request->GUI_number == '' || $request->GUI_number == null){
            $request->GUI_number = "";
        }
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
    			'owner_boss' => $request->owner_boss,//$request->owner_boss,
    			'DEPT' => $dept_name,//$dept_name,
    		])
    	]);

    	$response = $response->getBody()->getContents();

        return $response;
    }

    public function updateStatus(Organization $organization,Request $request)
    {
        //dd($request->all());

        //update
        $super = SupervisorCase::where('case_id',$request->id)->get();
        if($super->isNotEmpty()){
            $supervisor = SupervisorCase::find($super[0]['id']);
            $supervisor->status = $request->status;
            $supervisor->save();
        }else{
            
        }

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

    public function transfer(Organization $organization,Request $request)
    {
    	// $name = TransferCase::where('case_id',$request->id)->get();

     //    $user_id = $name[0]['id'];

     //    $user = User::where('id',$user_id)->get();

     //    $dept = Department::where('id',$user[0]['department_id']);

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
                'owner_boss' => '',//$user[0]['token'],
                'DEPT' => Auth::user()->department->name,//$user[0]['department_id'],
            ])
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function assignCase(Organization $organization,Request $request)
    {
        $end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

        $supervisor = SupervisorCase::where('user_id',Auth::user()->id)->whereBetween('time',[$request->start,$end])->get();

        return $supervisor;
    }

    public function searchStatus(Organization $organization,Request $request)
    {
        $status = $request->status;

        if($status == 'null'){
            $super = SupervisorCase::where('user_id',Auth::user()->id)->where('status',$status)->orWhere('status','')->get();
        }
        elseif($status == 'noselect'){
            $super = SupervisorCase::where('user_id',Auth::user()->id)->get();
        }
        else{
            $super = SupervisorCase::where('user_id',Auth::user()->id)->where('status',$status)->get();
        }

        $assign = User::where('organization_id',Auth::user()->organization_id)->get();

        return [$super,$assign];
    }

    public function searchAssign(Organization $organization,Request $request)
    {

        $super = SupervisorCase::where('user_id',Auth::user()->id)->whereBetween('time',[$request->start,$request->end])->get();

        return $super;
    }
}
