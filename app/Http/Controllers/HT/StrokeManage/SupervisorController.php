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
    	$supervisor = SupervisorCase::all();

    	return view('ht.StrokeManage.supervisor.index',compact('organization','supervisor'));
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

    public function getAssign(Organization $organization)
    {
    	$data = User::where('organization_id',Auth::user()->organization_id)->where('department_id',Auth::user()->department_id)->where('job','員工')->get();

    	return $data;
    }

    public function assignCaseBoss(Organization $organization,Request $request)
    {
    	$dept = User::where('token',$request->owner_boss)->get();

    	$dept_id = $dept[0]['department_id'];

    	$dept_name = Department::where('id',$dept_id)->get();

    	$dept_name = $dept_name[0]['name'];

    	//DB
    	$supervisor = new SupervisorCase;
    	$supervisor->user_id = Auth::user()->id;
    	$supervisor->case_id = $request->id;
    	$supervisor->cuskey = $request->name;
    	$supervisor->mobile = $request->mobile;
    	$supervisor->GUI_number = $request->GUI_number;
    	$supervisor->address = $request->address;
    	$supervisor->reason = $request->reason;
    	$supervisor->work_type = $request->work_type;
    	$supervisor->time = $request->time;
    	$supervisor->owner = $dept[0]['name'];
    	$supervisor->save();

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
    			'owner_boss' => 'Z8564d5737a4ba80b8e7921e882e506ea',//$request->owner_boss,
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

    public function transfer(Organization $organization,Request $request)
    {
    	$name = TransferCase::where('case_id',$request->id)->get();

        $user_id = $name[0]['id'];

        $user = User::where('id',$user_id);

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
                'owner_boss' => 'A20191002',//$user[0]['token'],
                'DEPT' => 'H026',//$user[0]['department_id'],
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }
}
