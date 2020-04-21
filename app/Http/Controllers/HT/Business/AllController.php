<?php

namespace App\Http\Controllers\HT\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\User;
use App\Business;
use App\BusinessTrack;
use App\BusinessCaseDetail;

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

        //拜訪紀錄-table
        $visitTable = Business::where('organization_name',$dept[0]['name'])->where('statusOpen','Y')->get();

        //案件追蹤-table
        $trackTable = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.address','businesses.phone')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->where('business_tracks.organization_name',$dept[0]['name'])
                ->where('business_tracks.statusTrack','Y')
                ->where('business_tracks.statusOpen','Y')
                ->get();


        //圖表-拜訪紀錄-不等於支援
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->where('type','!=','支援')
                            ->get();

        $noneHelpChartCount = count($chart);

        //圖表-拜訪紀錄-等於支援
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->where('type','=','支援')
                            ->get();

        $helpChartCount = count($chart);

        $businessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpChartCount),array("category"=>'非業務工作','column-1'=>$helpChartCount)];

        //圖表-拜訪紀錄-長條圖
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->get();
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $i = 0;

        foreach ($chart as $key => $value) {
            if($value['type'] == '其他'){
                $a += 1;
            }
            elseif($value['type'] == '協助安裝'){
                $b += 1;
            }
            elseif($value['type'] == '送文件'){
                $c += 1;
            }
            elseif($value['type'] == '收款'){
                $d += 1;
            }
            elseif($value['type'] == '送機器'){
                $e += 1;
            }
            elseif($value['type'] == '看現場'){
                $f += 1;
            }
            elseif($value['type'] == '洽機'){
                $g += 1;
            }
            elseif($value['type'] == '陌訪'){
                $h += 1;
            }
            elseif($value['type'] == '拜訪'){
                $i += 1;
            }
        }

        $businessChart = [array("category"=>'其他','column-1'=>$a),array("category"=>'協助安裝','column-1'=>$b),array("category"=>'送文件','column-1'=>$c),array("category"=>'收款','column-1'=>$d),array("category"=>'送機器','column-1'=>$e),array("category"=>'看現場','column-1'=>$f),array("category"=>'洽機','column-1'=>$g),array("category"=>'陌訪','column-1'=>$h),array("category"=>'拜訪','column-1'=>$i)];


        //圖表-追蹤數-業務分類
        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('business_tracks.updated_at','=',date('Y'))
                            ->whereMonth('business_tracks.updated_at','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','!=','支援')
                            ->get();

        $noneHelpTrackBusinessCount = count($chart);

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('business_tracks.updated_at','=',date('Y'))
                            ->whereMonth('business_tracks.updated_at','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','=','支援')
                            ->get();

        $HelpTrackBusinessCount = count($chart);

        $TrackBusinessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpTrackBusinessCount),array("category"=>'非業務工作','column-1'=>$HelpTrackBusinessCount)];

        //圖表-追蹤數&案件結單狀況
        $chart = BusinessTrack::whereYear('updated_at','=',date('Y'))
                                ->whereMonth('updated_at','=',date('m'))
                                ->where('organization_name',$dept[0]['name'])
                                ->where('statusTrack','Y')
                                ->where('statusOpen','Y')
                                ->get();

        $trackChartCount = count($chart);


        $a = 0;
        $b = 0;
        $c = 0;
        foreach ($chart as $key => $value) {
            if($value['result'] == '成交'){
                $a += 1;
            }
            elseif($value['result'] == '流單'){
                $b += 1;
            }
            elseif($value['result'] == '其他'){
                $c += 1;
            }
        }

        $resultChart = [array("category"=>'成交','column-1'=>$a),array("category"=>'流單','column-1'=>$b),array("category"=>'其他','column-1'=>$c)];

        //圖表-結單總筆數-參考成交總金額
        $chart = BusinessTrack::query()
                                ->select('business_case_details.total')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('business_tracks.updated_at','=',date('Y'))
                                ->whereMonth('business_tracks.updated_at','=',date('m'))
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.statusOpen','Y')
                                ->where('business_tracks.result','成交')
                                ->get();

        $finishChartCount = count($chart);

        $money = 0;
        foreach ($chart as $key => $value) {
            $money += $value['total'];
        }

        //圖表-新增客戶數
        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('business_tracks.updated_at','=',date('Y'))
                            ->whereMonth('business_tracks.updated_at','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','=','陌訪')
                            ->where('business_tracks.result','=','成交')
                            ->get();

        $newCustomChartCount = count($chart);

        //圖表-各機型銷售狀況-右邊表格
        $chart = BusinessTrack::query()
                            ->select('users.name','business_case_details.numbers','business_case_details.quantity')
                            ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                            ->leftjoin('users','users.id','=','business_tracks.user_id')
                            ->whereYear('business_tracks.updated_at','=',date('Y'))
                            ->whereMonth('business_tracks.updated_at','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('business_tracks.result','成交')
                            ->get();

        $userTable = array();
        $numberSelect = array();
        $userTableArray = array();

        foreach ($chart as $key => $value) {

            if(!in_array($value->name, $userTable)){
                array_push($userTable, $value->name);
            }

            if(!in_array($value->numbers, $numberSelect)){
                array_push($numberSelect, $value->numbers);
            }
        }

        foreach ($userTable as $k => $v) {

            $userTableArray[$v] = 0;

            foreach ($chart as $key => $value) {

                if($v == $value->name){
                    $userTableArray[$v] += $value->quantity;
                }
            }
        }

        //圖表-各機型銷售狀況-左邊圖表
        $chart = BusinessTrack::query()
                                ->select('business_case_details.numbers','business_case_details.quantity')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('business_tracks.updated_at','=',date('Y'))
                                ->whereMonth('business_tracks.updated_at','=',date('m'))
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.statusOpen','Y')
                                ->where('business_tracks.result','成交')
                                ->get();

        $number = array();
        $numberChart = array();
        $numberFinalChart = array();
        foreach ($chart as $key => $value) {
            if(!in_array($value->numbers, $number)){
                array_push($number, $value->numbers);
            }

        }

        foreach ($number as $key => $value) {

            $numberChart[$value] = 0;

            foreach ($chart as $k => $v) {
                if($value == $v->numbers){
                    $numberChart[$value] += $v->quantity;
                }
            }
        }

        foreach ($numberChart as $key => $value) {
            $numberFinalChart[] = array("category"=>$key,'column-1'=>$value);
        }

        return view('ht.Business.all.index',compact('organization','caseCount','deptUser','visitTable','trackTable','businessChartCount','businessChart','TrackBusinessChartCount','resultChart','trackChartCount','finishChartCount','money','newCustomChartCount','userTableArray','numberSelect','numberChart','numberFinalChart'));
    }

    public function show(Organization $organization,Request $request,$id)
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

        return view('ht.Business.all.show',compact('organization','caseCount'));
    }
}
