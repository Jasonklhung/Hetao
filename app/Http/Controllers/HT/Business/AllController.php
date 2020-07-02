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
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工'){
            $countArray = SupervisorCase::where('owner_id',Auth::user()->id)->whereIn('status',[null,'','F'])->get();

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

        // $visitNameArray = array();
        // foreach ($visitTable as $key => $value) {
        //     if(!in_array($value->business_name, $visitNameArray)){
        //         array_push($visitNameArray, $value->business_name);
        //     }
        // }

        //案件追蹤-table
        $trackTable = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.city','businesses.area','businesses.address','businesses.phone','business_case_details.numbers')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                ->where('business_tracks.organization_name',$dept[0]['name'])
                ->where('business_tracks.statusTrack','Y')
                ->where('business_tracks.statusOpen','Y')
                ->get();

        $trackIdArray = array();
        $trackIdArray2 = array();
        $trackDetailArray = array();
        $trackDetailResultArray = array();
        $trackSameArray = array();

        foreach ($trackTable as $key => $value) {
            if(!in_array($value->id, $trackIdArray)){
                array_push($trackIdArray, $value->id);
            }
        }

        foreach ($trackTable as $key => $value) {
            foreach ($trackIdArray as $k => $v) {
                if($value->id == $v){
                    $trackDetailArray[$v][] = $value->numbers;
                }
            }
        }

        foreach ($trackDetailArray as $key => $value) {

            $detailImplode = implode(',', $value);

            $trackDetailResultArray[] = array("id"=>$key,"detail"=>$detailImplode);
        }

        foreach ($trackTable as $key => $value) {
            if(!in_array($value->id, $trackIdArray2)){
                foreach ($trackDetailResultArray as $k => $v) {

                    if($v['id'] == $value->id){
                        $trackSameArray[] = array("id"=>$value->id,"date"=>$value->date,"level"=>$value->level,"schedule"=>$value->schedule,"category"=>$value->category,"name"=>$value->name,"business_name"=>$value->touch,"phone"=>$value->phone,"date_again"=>$value->date_again,"result"=>$value->result,"statusOpen"=>$value->statusOpen,"uniform_numbers"=>$value->uniform_numbers,"email"=>$value->email,"city"=>$value->city,"area"=>$value->area,"address"=>$value->address,"numbers"=>$v['detail']);
                    }

                }
                array_push($trackIdArray2, $value->id);
            }
        }

        $trackNumberArray = array();
        foreach ($trackTable as $key => $value) {
            if(!in_array($value->numbers, $trackNumberArray)){
                array_push($trackNumberArray, $value->numbers);
            }
        }


        //圖表-拜訪紀錄-不等於支援
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->where('type','!=','支援')
                            ->get();

        $noneHelpChartCount = count($chart);

        //圖表-拜訪紀錄-等於支援
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->where('type','=','支援')
                            ->get();

        $helpChartCount = count($chart);

        $businessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpChartCount),array("category"=>'非業務工作','column-1'=>$helpChartCount)];

        //圖表-拜訪紀錄-長條圖
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
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
        $j = 0;
        $k = 0;

        foreach ($chart as $key => $value) {
            if(strpos($value['type'],'其他') !== false){
                $a += 1;
            }
            if(strpos($value['type'],'協助安裝') !== false){
                $b += 1;
            }
            if(strpos($value['type'],'送文件') !== false){
                $c += 1;
            }
            if(strpos($value['type'],'收款') !== false){
                $d += 1;
            }
            if(strpos($value['type'],'送機器') !== false){
                $e += 1;
            }
            if(strpos($value['type'],'看現場') !== false){
                $f += 1;
            }
            if(strpos($value['type'],'洽機') !== false){
                $g += 1;
            }
            if(strpos($value['type'],'陌訪') !== false){
                $h += 1;
            }
            if(strpos($value['type'],'拜訪') !== false){
                $i += 1;
            }
            if(strpos($value['type'],'客訴') !== false){
                $j += 1;
            }
            if(strpos($value['type'],'客服') !== false){
                $k += 1;
            }
        }

        $businessChart = [array("category"=>'其他','column-1'=>$a),array("category"=>'協助安裝','column-1'=>$b),array("category"=>'送文件','column-1'=>$c),array("category"=>'收款','column-1'=>$d),array("category"=>'送機器','column-1'=>$e),array("category"=>'看現場','column-1'=>$f),array("category"=>'洽機','column-1'=>$g),array("category"=>'陌訪','column-1'=>$h),array("category"=>'拜訪','column-1'=>$i),array("category"=>'客訴','column-1'=>$j),array("category"=>'客服','column-1'=>$k)];

        //$allBusinessMonth = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k;
        $allBusinessMonth = count($chart);

        //圖表-追蹤數-業務分類
        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','!=','支援')
                            ->get();

        $noneHelpTrackBusinessCount = count($chart);

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','=','支援')
                            ->get();

        $HelpTrackBusinessCount = count($chart);

        $TrackBusinessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpTrackBusinessCount),array("category"=>'非業務工作','column-1'=>$HelpTrackBusinessCount)];

        //圖表-追蹤數&案件結單狀況
        // $chart = BusinessTrack::whereYear('updated_at','=',date('Y'))
        //                         ->whereMonth('updated_at','=',date('m'))
        //                         ->where('organization_name',$dept[0]['name'])
        //                         ->where('statusTrack','Y')
        //                         ->where('statusOpen','Y')
        //                         ->get();

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
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
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('businesses.date','=',date('Y'))
                                ->whereMonth('businesses.date','=',date('m'))
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
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
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
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
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
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->whereYear('businesses.date','=',date('Y'))
                                ->whereMonth('businesses.date','=',date('m'))
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

        return view('ht.Business.all.index',compact('organization','caseCount','deptUser','visitTable','trackTable','businessChartCount','businessChart','TrackBusinessChartCount','resultChart','trackChartCount','finishChartCount','money','newCustomChartCount','userTableArray','numberSelect','numberChart','numberFinalChart','allBusinessMonth','trackNumberArray','trackSameArray'));
    }

    public function show(Organization $organization,Request $request,$id)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $countArray = SupervisorCase::where('owner_id',Auth::user()->id)->whereIn('status',[null,'','F'])->get();

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

        $track = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.city','businesses.area','businesses.address','businesses.phone')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->where('business_tracks.id',$id)
                ->get();

        $case_track = BusinessTrack::find($id);
        $detail = BusinessCaseDetail::where('business_track_id',$id)->get();

        return view('ht.Business.all.show',compact('organization','caseCount','track','case_track','detail'));
    }

    public function visitSearch(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $start = $request->start;
        $end = $request->end;
        $time = $request->time;
        $business = $request->business;
        $type = $request->type;

        $visitTypeArray = array();

        $visitArray = Business::query()
        ->when($start, function ($query) use ($start,$end) {
            return $query->whereBetween('date',[$start,$end]);
        })
        ->when($time, function ($query) use ($time) {
            return $query->where('time',$time);
        })
        ->when($business, function ($query) use ($business) {
            return $query->where('user_id',$business);
        })
        ->where('organization_name',$dept[0]['name'])
        ->where('statusOpen','Y')
        ->get();

        if($type != null){
            foreach ($visitArray as $key => $value) {
                if(strpos($value->type,$type) !== false){ 
                    $visitTypeArray[] = $value;
                }
            }
        }
        else{
            $visitTypeArray = $visitArray;
        }

        return $visitTypeArray;
    }

    public function trackSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $business = $request->business;
        $level = $request->level;
        $schedule = $request->schedule;
        $category = $request->category;
        $numbers = $request->numbers;
        $result = $request->result;

        $dept = Organization::where('id',$organization->id)->get();

        $trackArray = BusinessTrack::query()
            ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.address','businesses.phone','business_case_details.numbers')
            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
            ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
            ->when($start, function ($query) use ($start,$end) {
                return $query->whereBetween('businesses.date',[$start,$end]);
            })
            ->when($level, function ($query) use ($level) {
                return $query->where('business_tracks.level',$level);
            })
            ->when($business, function ($query) use ($business) {
                return $query->where('business_tracks.user_id',$business);
            })
            ->when($schedule, function ($query) use ($schedule) {
                return $query->where('business_tracks.schedule',$schedule);
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('business_tracks.category',$category);
            })
            ->when($numbers, function ($query) use ($numbers) {
                return $query->where('business_case_details.numbers',$numbers);
            })
            ->when($result, function ($query) use ($result) {
                return $query->where('business_tracks.result',$result);
            })
            ->where('business_tracks.organization_name',$dept[0]['name'])
            ->where('business_tracks.statusTrack','Y')
            ->where('business_tracks.statusOpen','Y')
            ->get();

        return $trackArray;
    }

    public function monthSearch(Organization $organization,Request $request)
    {
        //dd($request->all());

        $year = explode('-', $request->month)[0];
        $month = explode('-', $request->month)[1];
        $business = $request->business;

        $dept = Organization::where('id',$organization->id)->get();

        //圖表-拜訪紀錄-長條圖
        $chart = Business::whereYear('date','=',$year)
                            ->whereMonth('date','=',$month)
                            ->where('organization_name',$dept[0]['name'])
                            ->where('statusOpen','Y')
                            ->when($business, function ($query) use ($business) {
                                return $query->where('user_id',$business);
                            })
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
        $j = 0;
        $k = 0;

        foreach ($chart as $key => $value) {
            if(strpos($value['type'],'其他') !== false){
                $a += 1;
            }
            if(strpos($value['type'],'協助安裝') !== false){
                $b += 1;
            }
            if(strpos($value['type'],'送文件') !== false){
                $c += 1;
            }
            if(strpos($value['type'],'收款') !== false){
                $d += 1;
            }
            if(strpos($value['type'],'送機器') !== false){
                $e += 1;
            }
            if(strpos($value['type'],'看現場') !== false){
                $f += 1;
            }
            if(strpos($value['type'],'洽機') !== false){
                $g += 1;
            }
            if(strpos($value['type'],'陌訪') !== false){
                $h += 1;
            }
            if(strpos($value['type'],'拜訪') !== false){
                $i += 1;
            }
            if(strpos($value['type'],'客訴') !== false){
                $j += 1;
            }
            if(strpos($value['type'],'客服') !== false){
                $k += 1;
            }
        }

        $businessChart = [array("category"=>'其他','column-1'=>$a),array("category"=>'協助安裝','column-1'=>$b),array("category"=>'送文件','column-1'=>$c),array("category"=>'收款','column-1'=>$d),array("category"=>'送機器','column-1'=>$e),array("category"=>'看現場','column-1'=>$f),array("category"=>'洽機','column-1'=>$g),array("category"=>'陌訪','column-1'=>$h),array("category"=>'拜訪','column-1'=>$i),array("category"=>'客訴','column-1'=>$j),array("category"=>'客服','column-1'=>$k)];

        $allBusinessMonth = count($chart);


        //圖表-案件結單狀況

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',$year)
                            ->whereMonth('businesses.date','=',$month)
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->when($business, function ($query) use ($business) {
                                return $query->where('business_tracks.user_id',$business);
                            })
                            ->get();


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
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('businesses.date','=',$year)
                                ->whereMonth('businesses.date','=',$month)
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.statusOpen','Y')
                                ->where('business_tracks.result','成交')
                                ->when($business, function ($query) use ($business) {
                                    return $query->where('business_tracks.user_id',$business);
                                })
                                ->get();

        //$finishChartCount = count($chart);

        $money = 0;
        foreach ($chart as $key => $value) {
            $money += $value['total'];
        }

        //圖表-新增客戶數
        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',$year)
                            ->whereMonth('businesses.date','=',$month)
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('businesses.type','=','陌訪')
                            ->where('business_tracks.result','=','成交')
                            ->when($business, function ($query) use ($business) {
                                return $query->where('business_tracks.user_id',$business);
                            })
                            ->get();

        $newCustomChartCount = count($chart);

        //圖表-各機型銷售狀況-左邊圖表
        $chart = BusinessTrack::query()
                                ->select('business_case_details.numbers','business_case_details.quantity')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->whereYear('businesses.date','=',$year)
                                ->whereMonth('businesses.date','=',$month)
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.statusOpen','Y')
                                ->where('business_tracks.result','成交')
                                ->when($business, function ($query) use ($business) {
                                    return $query->where('business_tracks.user_id',$business);
                                })
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

        //圖表-各機型銷售狀況-右邊表格
        $chart = BusinessTrack::query()
                            ->select('users.name','business_case_details.numbers','business_case_details.quantity')
                            ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                            ->leftjoin('users','users.id','=','business_tracks.user_id')
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',$year)
                            ->whereMonth('businesses.date','=',$month)
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('business_tracks.result','成交')
                            ->when($business, function ($query) use ($business) {
                                return $query->where('business_tracks.user_id',$business);
                            })
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

        return [$businessChart,$allBusinessMonth,$resultChart,$a,$money,$newCustomChartCount,$numberFinalChart,$userTableArray,$numberSelect];
    }

    public function numberSearch(Organization $organization,Request $request)
    {

        $number = $request->number;
        $year = explode('-',$request->month)[0];
        $month = explode('-',$request->month)[1];
        $business = $request->business;

        $dept = Organization::where('id',$organization->id)->get();

        $chart = BusinessTrack::query()
                                ->select('business_case_details.numbers','business_case_details.quantity')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->whereYear('businesses.date','=',$year)
                                ->whereMonth('businesses.date','=',$month)
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.statusOpen','Y')
                                ->where('business_tracks.result','成交')
                                ->when($number, function ($query) use ($number) {
                                    return $query->where('business_case_details.numbers',$number);
                                })
                                ->when($business, function ($query) use ($business) {
                                    return $query->where('business_tracks.user_id',$business);
                                })
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


        //圖表-各機型銷售狀況-右邊表格
        $chart = BusinessTrack::query()
                            ->select('users.name','business_case_details.numbers','business_case_details.quantity')
                            ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                            ->leftjoin('users','users.id','=','business_tracks.user_id')
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',$year)
                            ->whereMonth('businesses.date','=',$month)
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.statusTrack','Y')
                            ->where('business_tracks.statusOpen','Y')
                            ->where('business_tracks.result','成交')
                            ->when($number, function ($query) use ($number) {
                                    return $query->where('business_case_details.numbers',$number);
                                })
                            ->when($business, function ($query) use ($business) {
                                     return $query->where('business_tracks.user_id',$business);
                            })
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

        return [$numberFinalChart,$userTableArray];
    }
}
