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
use App\ReservationAnswer;

class SupervisorController extends Controller
{
    public function index(Organization $organization)
    {
    	$supervisor = SupervisorCase::where('organization_id',$organization->id)->whereIn('status',['','null'])->get();

        //$supervisor = SupervisorCase::where('organization_id',$organization->id)->where('status','')->orWhere('status','null')->get();

        $assign = User::where('organization_id',$organization->id)->where('token','!=','')->get();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
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
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        //線上預約
        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','reservation_answers.views','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',$organization->id)
                        ->get();


        //取得待指派工單
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $array = array();
        $NotAssignArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }

        foreach ($array as $key => $value) {
            if($value->owner == '' || $value->owner == null || $value->status == 'R'){
                $NotAssignArray[] = $value;
            }
        }

        //取得所有員工
        $allUser = User::whereIn('job',['助理','主管','員工','業務'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        //已指派工單
        $assignCaseArray = SupervisorCase::where('organization_id',$organization->id)->get();

    	return view('ht.StrokeManage.supervisor.index',compact('organization','supervisor','caseCount','assign','reservation','NotAssignArray','deptUser','assignCaseArray'));
    }

    public function index3(Organization $organization)
    {
        $supervisor = SupervisorCase::where('organization_id',$organization->id)->whereIn('status',['','null'])->get();

        //$supervisor = SupervisorCase::where('organization_id',$organization->id)->where('status','')->orWhere('status','null')->get();

        $assign = User::where('organization_id',$organization->id)->where('token','!=','')->get();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
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
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        return view('ht.StrokeManage.supervisor.index3',compact('organization','supervisor','caseCount','assign'));
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
                'token' => 'Uc514009f15eeca2f735f6debec395ba4',
                'DEPT' => $request->DEPT
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function getAssign(Organization $organization)
    {
        $dept = Organization::where('id',$organization->id)->get();

    	$allUser = User::all();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

    	return $deptUser;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {

    	$dept = User::where('token',$request->owner_boss)->get();

    	$dept_id = $dept[0]['department_id'];

    	$dept_name = Department::where('id',$dept_id)->get();

    	$dept_name = $dept_name[0]['name'];


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

        if(json_decode($response)->status == 200){
            //DB
            $supervisor = SupervisorCase::where('case_id',$request->id)->get();
            if($supervisor->isNotEmpty()){
                $supervisor = SupervisorCase::find($supervisor[0]['id']);
                $supervisor->organization_id = $organization->id;
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
                $supervisor->organization_id = $organization->id;
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
                $supervisor->status = '';
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

            return $response;
        }
        else{
            return $response;
        }

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
                'DEPT' => $organization->name,//$user[0]['department_id'],
            ])
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => $organization->name//$organization->name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function assignCase(Organization $organization,Request $request)
    {
        $end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

        $supervisor = SupervisorCase::where('organization_id',$organization->id)->whereBetween('time',[$request->start,$end])->get();

        return $supervisor;
    }

    public function searchStatus(Organization $organization,Request $request)
    {
        $status = $request->status;

        if($status == 'null'){
            $super = SupervisorCase::where('organization_id',$organization->id)->whereIn('status',['','null'])->get();
        }
        elseif($status == 'notselect'){
            $super = SupervisorCase::where('organization_id',$organization->id)->get();
        }
        else{
            $super = SupervisorCase::where('organization_id',$organization->id)->where('status',$status)->get();
        }

        $assign = User::where('organization_id',$organization->id)->get();

        return [$super,$assign];
    }

    public function searchAssign(Organization $organization,Request $request)
    {

        $super = SupervisorCase::where('organization_id',$organization->id)->whereBetween('time',[$request->start,$request->end])->get();

        return $super;
    }

    public function show(Organization $organization,$id)
    {

        $id = base64_decode($id);

        //dd($id);

        $res = ReservationAnswer::where('id',$id)->get();

        //更新狀態-是否查看
        $view = ReservationAnswer::find($id);
        $view->views = 'Y';
        $view->save();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
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
                'DEPT' => $dept[0]['name']//$organization->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        return view('ht.StrokeManage.supervisor.show',compact('organization','res','caseCount'));
    }

    public function assignOwner(Organization $organization,Request $request)
    {
        //dd($request->all());
        $user = User::find($request->owner);
        $dept = Organization::where('id',$organization->id)->get();

        //api update status
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $user->token,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => $dept[0]['name']
            ])
        ]);

        //取得待指派工單
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $array = array();
        $NotAssignArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }


        //取得指派的工單資訊
        foreach ($array as $key => $value) {
            if($value->id == $request->id){
                $getCaseArray[] = $value;
            }
        }

        $tt = 'GUI-number';

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/assign-case-boss', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'id' => $request->id,
                'name' => $getCaseArray[0]->CUSTKEY,
                'mobile'=> $getCaseArray[0]->mobile,
                'GUI_number' => $getCaseArray[0]->$tt,
                'address' => $getCaseArray[0]->address,
                'work_type' => $getCaseArray[0]->work_type,
                'time' => $getCaseArray[0]->time,
                'owner_boss' => $user->token,//$request->owner_boss,
                'DEPT' => $dept[0]['name'],//$dept_name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        if(json_decode($response)->status == 200){
            //DB
            $supervisor = SupervisorCase::where('case_id',$request->id)->get();
            if($supervisor->isNotEmpty()){
                $supervisor = SupervisorCase::find($supervisor[0]['id']);
                $supervisor->organization_id = $organization->id;
                $supervisor->user_id = Auth::user()->id;
                $supervisor->case_id = $request->id;
                $supervisor->cuskey = $getCaseArray[0]->CUSTKEY;
                $supervisor->mobile = $getCaseArray[0]->mobile;
                $supervisor->GUI_number = $getCaseArray[0]->$tt;
                $supervisor->address = $getCaseArray[0]->address;
                $supervisor->name = $getCaseArray[0]->name;
                $supervisor->reason = $getCaseArray[0]->remarks;
                $supervisor->work_type = $getCaseArray[0]->work_type;
                $supervisor->time = $getCaseArray[0]->time;
                $supervisor->owner = $user->name;
                $supervisor->owner_id = $request->owner;
                $supervisor->status = '';
                $supervisor->save();
            }else{
                $supervisor = new SupervisorCase;
                $supervisor->organization_id = $organization->id;
                $supervisor->user_id = Auth::user()->id;
                $supervisor->case_id = $request->id;
                $supervisor->cuskey = $getCaseArray[0]->CUSTKEY;
                $supervisor->mobile = $getCaseArray[0]->mobile;
                $supervisor->GUI_number = $getCaseArray[0]->$tt;
                $supervisor->address = $getCaseArray[0]->address;
                $supervisor->name = $getCaseArray[0]->name;
                $supervisor->reason = $getCaseArray[0]->remarks;
                $supervisor->work_type = $getCaseArray[0]->work_type;
                $supervisor->time = $getCaseArray[0]->time;
                $supervisor->owner = $user->name;
                $supervisor->owner_id = $request->owner;
                $supervisor->status = '';
                $supervisor->save();
            }

            return array("status"=>200);
        }
        else{
            return array("status"=>400);
        }
    }

    public function assignOwnerAgain(Organization $organization,Request $request)
    {
        //dd($request->all());

        $user = User::find($request->owner);
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $user->token,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => $dept[0]['name']
            ])
        ]);

        //取得待指派工單
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $array = array();
        $AssignArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }

        //取得指派的工單資訊
        foreach ($array as $key => $value) {
            if($value->id == $request->id){
                $AssignArray[] = $value;
            }
        }

        $tt = 'GUI-number';

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/assign-case-boss', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'id' => $request->id,
                'name' => $AssignArray[0]->CUSTKEY,
                'mobile'=> $AssignArray[0]->mobile,
                'GUI_number' => $AssignArray[0]->$tt,
                'address' => $AssignArray[0]->address,
                'work_type' => $AssignArray[0]->work_type,
                'time' => $AssignArray[0]->time,
                'owner_boss' => $user->token,//$request->owner_boss,
                'DEPT' => $dept[0]['name'],//$dept_name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        if(json_decode($response)->status == 200){
            //DB
            $supervisor = SupervisorCase::where('case_id',$request->id)->get();
            if($supervisor->isNotEmpty()){
                $supervisor = SupervisorCase::find($supervisor[0]['id']);
                $supervisor->organization_id = $organization->id;
                $supervisor->user_id = Auth::user()->id;
                $supervisor->case_id = $request->id;
                $supervisor->cuskey = $AssignArray[0]->CUSTKEY;
                $supervisor->mobile = $AssignArray[0]->mobile;
                $supervisor->GUI_number = $AssignArray[0]->$tt;
                $supervisor->address = $AssignArray[0]->address;
                $supervisor->name = $AssignArray[0]->name;
                $supervisor->reason = $AssignArray[0]->remarks;
                $supervisor->work_type = $AssignArray[0]->work_type;
                $supervisor->time = $AssignArray[0]->time;
                $supervisor->owner = $user->name;
                $supervisor->owner_id = $request->owner;
                $supervisor->status = '';
                $supervisor->save();
            }else{
                $supervisor = new SupervisorCase;
                $supervisor->organization_id = $organization->id;
                $supervisor->user_id = Auth::user()->id;
                $supervisor->case_id = $request->id;
                $supervisor->cuskey = $AssignArray[0]->CUSTKEY;
                $supervisor->mobile = $AssignArray[0]->mobile;
                $supervisor->GUI_number = $AssignArray[0]->$tt;
                $supervisor->address = $AssignArray[0]->address;
                $supervisor->name = $AssignArray[0]->name;
                $supervisor->reason = $AssignArray[0]->remarks;
                $supervisor->work_type = $AssignArray[0]->work_type;
                $supervisor->time = $AssignArray[0]->time;
                $supervisor->owner = $user->name;
                $supervisor->owner_id = $request->owner;
                $supervisor->status = '';
                $supervisor->save();
            }

            return array("status"=>200);
        }
        else{
            return array("status"=>400);
        }
    }

    public function onlineSearch(Organization $organization,Request $request)
    {

        $start = $request->start;
        $end = $request->end;
        $end = date("Y-m-d",strtotime("+1 day",strtotime($end)));
        $status = $request->status;

        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','reservation_answers.views','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',$organization->id)
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('reservation_answers.created_at',[$start,$end]);
                        })
                        ->when($status, function ($query) use ($status) {
                            return $query->where('views',$status);
                        })
                        ->get();

        return $reservation;
    }

    public function notAssignSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $type = $request->type;

        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $array = array();
        $NotAssignArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }

        foreach ($array as $key => $value) {
            if($value->owner == '' || $value->owner == null || $value->status == 'R'){
                $NotAssignArray[] = $value;
            }
        }

        $searchArray = array();

        if($start != null && $end != null && $type != null){

            foreach ($NotAssignArray as $key => $value) {
                if($value->time >= $start && $value->time <= $end && $value->work_type == $type){
                    $searchArray[] = $value;
                }
            }
        }
        elseif($start != null && $end != null && $type == null){

            foreach ($NotAssignArray as $key => $value) {
                if($value->time >= $start && $value->time <= $end){
                    $searchArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $type != null){

            foreach ($NotAssignArray as $key => $value) {
                if($value->work_type == $type){
                    $searchArray[] = $value;
                }
            }
        }

        //取得所有員工
        $allUser = User::whereIn('job',['助理','主管','員工'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        return [$searchArray,$deptUser];
    }

    public function assignCaseSearch(Organization $organization,Request $request)
    {

        $start = $request->start;
        $end = $request->end;
        $type = $request->type;
        $status = $request->status;
        $staff = $request->staff;

        $assignCaseArray = SupervisorCase::where('organization_id',$organization->id)
                                        ->when($start, function ($query) use ($start,$end) {
                                            return $query->whereBetween('time',[$start,$end]);
                                        })
                                        ->when($type, function ($query) use ($type) {
                                            return $query->where('work_type',$type);
                                        })
                                        ->when($staff, function ($query) use ($staff) {
                                            return $query->where('owner',$staff);
                                        })
                                        ->when($status, function ($query) use ($status) {
                                            return $query->where('status',$status);
                                        })
                                        ->get();

        //取得所有員工
        $dept = Organization::where('id',$organization->id)->get();
        $allUser = User::whereIn('job',['助理','主管','員工'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        return [$assignCaseArray,$deptUser];
    }
}
