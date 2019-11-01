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

use GuzzleHttp\Client;

class AssistantController extends Controller
{
    public function index(Organization $organization)
    {
        $reservation = DB::table('reservation_answers')
                        ->select('reservation_answers.id','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->get();

        $contact = ContactAnswer::all();

    	return view('ht.StrokeManage.assistant.index',compact('organization','reservation','contact'));
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

    public function show(Organization $organization,$id)
    {
        $id = base64_decode($id);

        $res = ReservationAnswer::where('id',$id)->get();

    	return view('ht.StrokeManage.assistant.show',compact('organization','res'));
    }

    public function resSearch(Organization $organization,Request $request)
    { 
        $end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

        $data = DB::table('reservation_answers')
                        ->select('reservation_answers.id','accounts.cuskey','accounts.name','reservation_answers.created_at')
                        ->leftjoin('accounts','reservation_answers.account_id','=','accounts.id')
                        ->where('reservation_answers.department_id',Auth::user()->department_id)
                        ->whereBetween('reservation_answers.created_at',[$request->start,$end])
                        ->get();

        return $data;
    }

    public function contactSearch(Organization $organization,Request $request)
    { 
        $end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

        $data = ContactAnswer::whereBetween('created_at',[$request->start,$end])->get();

        return $data;
    }

    public function showContact(Organization $organization,$id)
    {
        $id = base64_decode($id);

        $res = ContactAnswer::where('id',$id)->get();

        return view('ht.StrokeManage.assistant.showContact',compact('organization','res'));
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
    	$data = User::where('organization_id',Auth::user()->organization_id)->get();

    	return $data;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {
        //dd($request->all());

    	$dept = User::where('token',$request->owner_boss)->get();

    	$dept_id = $dept[0]['department_id'];

    	$dept_name = Department::where('id',$dept_id)->get();

    	$dept_name = $dept_name[0]['name']; //取得部門名稱

        
        $case = TransferCase::where('case_id',$request->id)->get();

        if($case->isNotEmpty()){
            DB::table('transfer_cases')
                ->where('case_id',$request->id)
                ->update(['id' => Auth::user()->id]);
        }else{
            $transfer = new TransferCase;
            $transfer->user_id = Auth::user()->id;
            $transfer->case_id = $request->id;
            $transfer->save();
        }

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
    			'owner_boss' => $request->owner_boss,//$request->remarks,
    			'DEPT' => Auth::user()->department->name,//$dept_name,
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

    public function transfer(Organization $organization,Request $request)
    {
        $name = TransferCase::where('case_id',$request->id)->get();

        $user_id = $name[0]['id'];

        $user = User::where('id',$user_id)->get();

        $dept = Department::where('id',$user[0]['department_id']);

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
                'owner_boss' => $user[0]['token'],//$user[0]['token'],
                'DEPT' => $dept[0]['name'],//$user[0]['department_id'],
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

}

