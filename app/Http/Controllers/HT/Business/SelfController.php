<?php

namespace App\Http\Controllers\HT\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use DB;
use App\Business;
use App\BusinessTrack;
use App\BusinessCaseDetail;

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

        //拜訪紀錄
        $dept = Organization::where('id',$organization->id)->get();
        $visit = Business::where('user_id',Auth::user()->id)->where('organization_name',$dept[0]['name'])->get();

        //案件追蹤
        $track = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.address','businesses.phone')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->where('business_tracks.user_id',Auth::user()->id)
                ->where('business_tracks.organization_name',$dept[0]['name'])
                ->where('business_tracks.statusTrack','Y')
                ->get();

        //圖表-拜訪紀錄-不等於支援
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('user_id',Auth::user()->id)
                            ->where('type','!=','支援')
                            ->get();

        $noneHelpChartCount = count($chart);

        //圖表-拜訪紀錄-等於支援
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('user_id',Auth::user()->id)
                            ->where('type','=','支援')
                            ->get();

        $helpChartCount = count($chart);

        $businessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpChartCount),array("category"=>'非業務工作','column-1'=>$helpChartCount)];

        //圖表-拜訪紀錄-長條圖
        $chart = Business::whereYear('updated_at','=',date('Y'))
                            ->whereMonth('updated_at','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('user_id',Auth::user()->id)
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
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->where('businesses.type','!=','支援')
                            ->get();

        $noneHelpTrackBusinessCount = count($chart);

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('business_tracks.updated_at','=',date('Y'))
                            ->whereMonth('business_tracks.updated_at','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->where('businesses.type','=','支援')
                            ->get();

        $HelpTrackBusinessCount = count($chart);

        $TrackBusinessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpTrackBusinessCount),array("category"=>'非業務工作','column-1'=>$HelpTrackBusinessCount)];

        //圖表-追蹤數&案件結單狀況
        $chart = BusinessTrack::whereYear('updated_at','=',date('Y'))
                                ->whereMonth('updated_at','=',date('m'))
                                ->where('organization_name',$dept[0]['name'])
                                ->where('user_id',Auth::user()->id)
                                ->where('statusTrack','Y')
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
                                ->where('business_tracks.user_id',Auth::user()->id)
                                ->where('business_tracks.statusTrack','Y')
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
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->where('businesses.type','=','陌訪')
                            ->where('business_tracks.result','=','成交')
                            ->get();

        $newCustomChartCount = count($chart);

        //圖表-各機型銷售狀況
        $chart = BusinessTrack::query()
                                ->select('business_case_details.numbers','business_case_details.quantity')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('business_tracks.updated_at','=',date('Y'))
                                ->whereMonth('business_tracks.updated_at','=',date('m'))
                                ->where('business_tracks.organization_name',$dept[0]['name'])
                                ->where('business_tracks.user_id',Auth::user()->id)
                                ->where('business_tracks.statusTrack','Y')
                                ->where('business_tracks.result','成交')
                                ->get();

        $number = array();
        $numberChart = array();
        $numberTotalChart = 0;
        foreach ($chart as $key => $value) {
            if(!in_array($value->numbers, $number)){
                array_push($number, $value->numbers);
            }

            $numberTotalChart += $value->quantity;
        }

        foreach ($number as $key => $value) {

            $numberChart[$value] = 0;

            foreach ($chart as $k => $v) {
                if($value == $v->numbers){
                    $numberChart[$value] += $v->quantity;
                }
            }
        }

        return view('ht.Business.self.index',compact('organization','caseCount','visit','track','businessChartCount','businessChart','trackChartCount','TrackBusinessChartCount','resultChart','finishChartCount','money','newCustomChartCount','numberChart','numberTotalChart'));
    }

    public function create(Organization $organization)
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

        return view('ht.Business.self.create',compact('organization','caseCount'));
    }

    public function store(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $business = new Business;
        $business->user_id = Auth::user()->id;
        $business->organization_name = $dept[0]['name'];
        $business->business_name = $request->business_name;
        $business->date = $request->date;
        $business->time = $request->time;
        $business->name = $request->name;
        $business->type = $request->type;
        $business->content = $request->content;
        $business->city = $request->city;
        $business->area = $request->area;
        $business->address = $request->address;
        $business->phone = $request->phone;
        $business->other = $request->other;

        if($request->hasFile('file'))
        {

            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('/upload/business',$filename,'public_uploads');

            $upload = '/upload/business/'.$filename;
            $business->file = $upload;
        }

        (isset($request->statusTrack))? $business->statusTrack = 'Y' : $business->statusTrack = 'N';

        $business->save();

        $track = new BusinessTrack;
        $track->business_id = $business->id;
        $track->user_id = Auth::user()->id;
        $track->organization_name = $dept[0]['name'];
        (isset($request->statusTrack))? $track->statusTrack = 'Y' : $track->statusTrack = 'N';
        $track->save();

        return redirect()->route('ht.Business.self.index',compact('organization'))->with('success','業務新增成功');
    }

    public function update(Organization $organization,Request $request,$id)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $visit = Business::find($id);
        $visit->user_id = Auth::user()->id;
        $visit->organization_name = $dept[0]['name'];
        $visit->business_name = $request->business_name;
        $visit->date = $request->date;
        $visit->time = $request->time;
        $visit->name = $request->name;
        $visit->type = $request->type;
        $visit->content = $request->content;
        $visit->city = $request->city;
        $visit->area = $request->area;
        $visit->address = $request->address;
        $visit->phone = $request->phone;
        $visit->other = $request->other;

        if($request->hasFile('file'))
        {
            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('/upload/business',$filename,'public_uploads');

            $upload = '/upload/business/'.$filename;
            $visit->file = $upload;
        }

        (isset($request->statusTrack))? $visit->statusTrack = 'Y' : $visit->statusTrack = 'N';

        $visit->save();

        (isset($request->statusTrack))? $track = BusinessTrack::where('business_id', '=', $id)->update(['statusTrack' => 'Y']) : BusinessTrack::where('business_id', '=', $id)->update(['statusTrack' => 'N']);

        return redirect()->route('ht.Business.self.index',compact('organization'))->with('success','業務修改成功');
    }

    public function visitEdit(Organization $organization,Request $request,$id)
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

        $visit = Business::find($request->id);

        return view('ht.Business.self.visitEdit',compact('organization','caseCount','visit'));
    }

    public function trackEdit(Organization $organization,Request $request,$id)
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

        //案件追蹤
        $dept = Organization::where('id',$organization->id)->get();
        $track = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.city','businesses.area','businesses.address','businesses.phone')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->where('business_tracks.user_id',Auth::user()->id)
                ->where('business_tracks.organization_name',$dept[0]['name'])
                ->where('business_tracks.id',$id)
                ->get();

        $case_track = BusinessTrack::find($id);
        $detail = BusinessCaseDetail::where('business_track_id',$id)->get();

        return view('ht.Business.self.trackEdit',compact('organization','caseCount','track','id','case_track','detail'));
    }

    public function trackUpdate(Organization $organization,Request $request,$id)
    {

        //案件追蹤
        $track = BusinessTrack::find($id);
        $track->date_again = $request->date_again;
        $track->level = $request->level;
        $track->schedule = $request->schedule;
        $track->category = $request->category;
        $track->touch = $request->touch;
        $track->uniform_numbers = $request->uniform_numbers;
        $track->email = $request->email;
        $track->result = $request->result;
        $track->reason = $request->reason;
        $track->other = $request->other;
        $track->save();

        //案件追蹤-訂單
        for ($i=1; $i < $request->detailLength ; $i++) { 

            $detail = new BusinessCaseDetail;

            $row = explode(',',$request->{'detail'.$i});

            $detail->business_track_id = $id;
            $detail->numbers = $row[0];
            $detail->money = $row[1];
            $detail->quantity = $row[2];
            $detail->total = $row[3];
            $detail->description = $row[4];
            $detail->save();
        }

        //拜訪紀錄
        $visit = Business::find($track->business_id);
        $visit->date = $request->date;
        $visit->name = $request->name;
        $visit->phone = $request->phone;
        $visit->city = $request->city;
        $visit->area = $request->area;
        $visit->address = $request->address;
        $visit->save();

        return array("status"=>200);

    }

    public function businessVisitChangeStatus(Organization $organization,Request $request)
    {
        if($request->type == 'open'){

            $visit = Business::find($request->id);
            $visit->statusOpen = 'Y';
            $visit->save();
        }
        elseif($request->type == 'track'){

            $visit = Business::find($request->id);
            $visit->statusTrack = 'Y';
            $visit->save();

            $track = BusinessTrack::where('business_id', '=', $visit->id)->update(['statusTrack' => 'Y']);
        }
        elseif($request->type == 'delete'){

            $visit = Business::find($request->id);
            $visit->delete();
        }

        return array('status'=>200);
    }

    public function businessTrackChangeStatus(Organization $organization,Request $request)
    {

        if($request->type == 'open'){

            $track = BusinessTrack::find($request->id);
            $track->statusOpen = 'Y';
            $track->save();
        }
        elseif($request->type == 'delete'){

            $track = BusinessTrack::find($request->id);
            $track->delete();
        }

        return array('status'=>200);
    }
}
