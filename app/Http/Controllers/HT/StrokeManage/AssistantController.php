<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\Organization;
use App\WorkCase;
use App\User;
use App\Department;
use App\TransferCase;
use App\ReservationAnswer;
use App\ContactAnswer;
use App\SupervisorCase;

use GuzzleHttp\Client;

class AssistantController extends Controller
{
    public function index(Organization $organization)
    {
        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','reservation_answers.views','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->get();

        $contact = ContactAnswer::all();

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

    	return view('ht.StrokeManage.assistant.index',compact('organization','reservation','contact','caseCount'));
    }

    public function index2(Organization $organization)
    {
        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->get();

        $contact = ContactAnswer::all();

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

        return view('ht.StrokeManage.assistant.index2',compact('organization','reservation','contact','caseCount'));
    }

    public function index3(Organization $organization)
    {
        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->get();

        $contact = ContactAnswer::all();

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

        return view('ht.StrokeManage.assistant.index3',compact('organization','reservation','contact','caseCount'));
    }

    public function create(Organization $organization)
    {
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

    	return view('ht.StrokeManage.assistant.create',compact('organization','caseCount'));
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

    public function edit(Organization $organization,$id)
    {
        $id = base64_decode($id);

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,
                'DEPT' => Auth::user()->department->name
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;

                foreach ($array as $k => $v) {
                    if($v->id == $id){
                        $res = $v;
                    }
                }
            }
        }

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

    	return view('ht.StrokeManage.assistant.edit',compact('organization','res','caseCount'));
    }

    public function update(Organization $organization,Request $request)
    {
        //dd($request->all());

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-online-work', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'work_type' => $request->work_type,
                'time' => $request->time,
                'remarks' => $request->remarks,
                'address' => $request->address,
                'CUSTKEY' => $request->CUSTKEY,
                'id' => $request->id,
                'DEPT' => Auth::user()->department->name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        return redirect()->route('ht.StrokeManage.assistant.index',['tab'=>'case'],compact('organization'))->with('success','編輯成功');
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

    	return view('ht.StrokeManage.assistant.show',compact('organization','res','caseCount'));
    }

    public function resSearch(Organization $organization,Request $request)
    { 

        $data = DB::table('reservation_answers')
                        ->select('reservation_answers.id','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->whereBetween('reservation_answers.created_at',[$request->start,$request->end])
                        ->get();

        return $data;
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

    public function getSupervisor(Organization $organization)
    {
    	$data = User::where('organization_id','28')->get();

    	return $data;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {
        //dd($request->all());

    	$dept = User::where('token',$request->owner_boss)->get();

        $dept_id = $dept[0]['department_id'];

        $dept_name = Department::where('id',$dept_id)->get();

        $dept_name = $dept_name[0]['name'];

        
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
        $response2 = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
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
    			'owner_boss' => $request->owner_boss,//$request->remarks,
    			'DEPT' => $dept_name//$dept_name,
    		])
    	]);

    	$response = $response->getBody()->getContents();

        return $response;
    }

    public function updateStatus(Organization $organization,Request $request)
    {
        //dd($request->all());

        //updateStatus
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

        // $user_id = $name[0]['id'];

        // $user = User::where('id',$user_id)->get();

        // $dept = Department::where('id',$user[0]['department_id']);

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
                'DEPT' => Auth::user()->department->name,//Auth::user()->department->name,
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

}

