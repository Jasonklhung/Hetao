<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\TransferCase;
use App\User;

use GuzzleHttp\Client;

class StaffController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.StrokeManage.staff.index',compact('organization'));
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
                'owner_boss' => 'B20191002',//$user[0]['token'],
                'DEPT' => 'H026',//$user[0]['department_id'],
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }
}
