<?php

namespace App\Http\Controllers\HT\Cycle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\User;
use App\CycleAssign;
use Carbon\Carbon;

class SelfController extends Controller
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

        //個人週期循環
        $dept = Organization::where('id',$organization->id)->get();
        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','!=','F')->get();

        //週期進度
        $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','F')->get();
        $cycleNext = array();

        foreach ($cycleFinish as $key => $value) {

            $cycleNext[] = array("kind"=>$value->kind,"custkey"=>$value->custkey,"touch"=>$value->touch,"companyTel"=>$value->companyTel,"finishDate"=>$value->thisDate,"nextDate"=>Carbon::parse($value->thisDate)->addDays($value->cycle)->format('Y-m-d'),"cycle"=>$value->cycle,"area"=>$value->area,"staff"=>$value->staff,"homeTel"=>$value->homeTel,"mobile"=>$value->mobile,"machine"=>$value->machine,"payAddress"=>$value->payAddress,"productCode"=>$value->productCode,"productNum"=>$value->productNum,"productPrice"=>$value->productPrice,"other"=>$value->other);
        }

        //週期進度-圖表
        $cycleS = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','S')->count(); //執行中
        $cycleF = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','F')->count(); //已完成
        $cycleT = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','T')->count(); //轉單
        $cycleTotal = $cycleS+$cycleF+$cycleT;

        $cycleS = ($cycleS/$cycleTotal)*100;
        $cycleF = ($cycleF/$cycleTotal)*100;
        $cycleT = ($cycleT/$cycleTotal)*100;

        return view('ht.Cycle.self.index',compact('organization','caseCount','cycle','cycleNext','cycleS','cycleF','cycleT'));
    }

    public function changeDate(Organization $organization,Request $request)
    {
        $cycle = CycleAssign::find($request->id);
        $cycle->thisDate = $request->date;
        $cycle->save();

        return array("status"=>200);
    }

    public function cycleFinish(Organization $organization,Request $request)
    {
        $cycle = CycleAssign::find($request->id);
        $cycle->status = 'F';
        $cycle->save();

        return array("status"=>200);
    }

    public function cycleTurn(Organization $organization,Request $request)
    {
        $cycle = CycleAssign::find($request->id);
        $cycle->status = 'T';

        if($request->radio = 'newDate'){

            $cycle->turnReason = "客戶另約日期,下次日期為:".$request->reason;
        }
        elseif($request->radio = 'notChange'){

            $cycle->turnReason = "客戶不需更換";
        }
        elseif($request->radio = 'other'){

            $cycle->turnReason = "其他:".$request->reason;
        }

        return array("stauts"=>200);
    }
}
