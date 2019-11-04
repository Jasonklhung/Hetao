<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\TransferCase;
use App\User;
use App\Department;

use Auth;
use GuzzleHttp\Client;

class StaffController extends Controller
{
    public function index(Organization $organization)
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

    	return view('ht.StrokeManage.staff.index',compact('organization','caseCount'));
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

    public function updateStatus(Organization $organization,Request $request)
    {
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

        $user_id = $name[0]['user_id'];

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
