<?php

namespace App\Http\Controllers\HT\Cycle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\User;
use App\CycleAssign;

class AllController extends Controller
{
    public function index(Organization $organization)
    {
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
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        //全站週期
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-clients', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $cycle = $value;
            }
        }

        $allAssign = array();

        $assign = CycleAssign::where('organization_name',$dept[0]['name'])->where('statusERP','N')->get();

        foreach ($assign as $key => $value) {
            array_push($allAssign, $value->kind);
        }

        //全部分公司使用者
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

        return view('ht.Cycle.all.index',compact('organization','caseCount','cycle','deptUser','allAssign','assign'));
    }

    public function cycleAssign(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-clients', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $cycle = $value;
            }
        }

        foreach ($cycle as $key => $value) {
            if($value->KIND == $request->id){

                $staff = User::find($request->staff);

                $cycle = new CycleAssign;
                $cycle->organization_name = $dept[0]['name'];
                $cycle->kind = $value->KIND;
                $cycle->custkey = $value->CUSTKEY;
                $cycle->touch = $value->TOUCH;
                $cycle->companyTel = $value->COMTEL;
                $cycle->lastDate = $value->LSTDATE;
                $cycle->thisDate = $value->NXTDATE;
                $cycle->cycle = $value->CYCLE;
                $cycle->area = $value->AREA;
                $cycle->staff = $staff['name'];
                $cycle->homeTel = $value->HOMETEL;
                $cycle->mobile = $value->MPHONE;
                $cycle->machine = $value->MACHINE;
                $cycle->payAddress = $value->PAYMENT;
                $cycle->productCode = $value->CODE;
                $cycle->productNum = $value->NUM;
                $cycle->productPrice = $value->PRICE;
                $cycle->other = $value->MEMO;
                $cycle->save();
            }
        }

        return array("status"=>200);
    }
}
