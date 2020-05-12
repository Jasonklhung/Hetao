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
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//Auth::user()->department->name//Auth::user()->department->name
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
                'DEPT' => $dept[0]['name']//Auth::user()->department->name//Auth::user()->department->name
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
        $cycleArray = array();
        $dept = Organization::where('id',$organization->id)->get();
        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->whereNotIn('status',['F','T'])->get();

        foreach ($cycle as $key => $value) {
            if(!in_array($value->kind, $cycleArray)){
                array_push($cycleArray, $value->kind);
            } 
        }

        $cycleArrayCount = count($cycleArray);

        //週期進度
        $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','F')->get();
        $cycleNext = array();
        $cycleCategory = array();

        foreach ($cycleFinish as $key => $value) {

            $cycleNext[] = array("kind"=>$value->kind,"custkey"=>$value->custkey,"touch"=>$value->touch,"companyTel"=>$value->companyTel,"finishDate"=>$value->thisDate,"nextDate"=>Carbon::parse($value->thisDate)->addDays($value->cycle)->format('Y-m-d'),"cycle"=>$value->cycle,"area"=>$value->area,"staff"=>$value->staff,"homeTel"=>$value->homeTel,"mobile"=>$value->mobile,"machine"=>$value->machine,"payAddress"=>$value->payAddress,"productCode"=>$value->productCode,"productNum"=>$value->productNum,"productPrice"=>$value->productPrice,"other"=>$value->other);
        }

        foreach ($cycleNext as $key => $value) {
            if(!in_array($value['productCode'], $cycleCategory)){
                array_push($cycleCategory, $value['productCode']);
            } 
        }

        //週期進度-圖表
        $cycleS = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','S')->count(); //執行中
        $cycleF = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','F')->count(); //已完成
        $cycleT = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',Auth::user()->name)->where('status','=','T')->count(); //轉單
        $cycleTotal = $cycleS+$cycleF+$cycleT;

        if($cycleS != 0){
            $cycleS = ($cycleS/$cycleTotal)*100;
        }

        if($cycleF != 0){
            $cycleF = ($cycleF/$cycleTotal)*100;
        }

        if($cycleT != 0){
            $cycleT = ($cycleT/$cycleTotal)*100;
        }

        return view('ht.Cycle.self.index',compact('organization','caseCount','cycle','cycleNext','cycleS','cycleF','cycleT','cycleCategory','cycleArrayCount'));
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

        if($request->radio == 'newDate'){

            $cycle->turnReason = "客戶另約日期,下次日期為:".$request->reason;
        }
        elseif($request->radio == 'notChange'){

            $cycle->turnReason = "客戶不需更換";
        }
        elseif($request->radio == 'other'){

            $cycle->turnReason = "其他:".$request->reason;
        }

        $cycle->save();

        return array("status"=>200);
    }

    public function cycleReportSearch(Organization $organization,Request $request)
    {
        $startDate = $request->start;
        $endDate = $request->end;

        $dept = Organization::where('id',$organization->id)->get();

        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])
                            ->where('staff',Auth::user()->name)
                            ->where('status','S')
                            ->where('thisDate','>=',$startDate)
                            ->where('thisDate','<=',$endDate)
                            ->get();

        $cycleArray = array();
        foreach ($cycle as $key => $value) {
            if(!in_array($value->kind, $cycleArray)){
                array_push($cycleArray, $value->kind);
            } 
        }

        $cycleArrayCount = count($cycleArray);

        return [$cycle,$cycleArrayCount];
    }

    public function thisDateChange(Organization $organization,Request $request)
    {
        $id = explode('thisDate', $request->id)[1];

        $value = $request->value;

        $cycle = CycleAssign::find($id);
        $cycle->thisDate = $value;
        $cycle->save();

        return array("status"=>200);
    }

    public function cycleNowSearch(Organization $organization,Request $request)
    {
        //dd($request->all());

        $code = $request->code;
        $start = $request->start;
        $end = $request->end;

        $dept = Organization::where('id',$organization->id)->get();
        $cycleNextArray = array();

        if($code != null && $start != null && $end != null){

            $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])
                                    ->where('staff',Auth::user()->name)
                                    ->where('status','=','F')
                                    ->where('productCode',$request->code)
                                    ->where('thisDate','>=',$request->start)
                                    ->where('thisDate','<=',$request->end)
                                    ->get();
        }
        elseif($code != null && $start == null && $end == null){

            $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])
                                    ->where('staff',Auth::user()->name)
                                    ->where('status','=','F')
                                    ->where('productCode',$request->code)
                                    ->get();
        }
        elseif($code == null && $start != null && $end != null){

            $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])
                                    ->where('staff',Auth::user()->name)
                                    ->where('status','=','F')
                                    ->where('thisDate','>=',$request->start)
                                    ->where('thisDate','<=',$request->end)
                                    ->get();
        }
        


        foreach ($cycleFinish as $key => $value) {

            $cycleNextArray[] = array("kind"=>$value->kind,"custkey"=>$value->custkey,"touch"=>$value->touch,"companyTel"=>$value->companyTel,"finishDate"=>$value->thisDate,"nextDate"=>Carbon::parse($value->thisDate)->addDays($value->cycle)->format('Y-m-d'),"cycle"=>$value->cycle,"area"=>$value->area,"staff"=>$value->staff,"homeTel"=>$value->homeTel,"mobile"=>$value->mobile,"machine"=>$value->machine,"payAddress"=>$value->payAddress,"productCode"=>$value->productCode,"productNum"=>$value->productNum,"productPrice"=>$value->productPrice,"other"=>$value->other);
        }

        return $cycleNextArray;
    }
}
