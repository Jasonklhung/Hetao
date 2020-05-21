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
use App\Notice;
use App\Exports\BusinessDownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

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

        //拜訪紀錄
        $dept = Organization::where('id',$organization->id)->get();
        $visit = Business::where('user_id',Auth::user()->id)->where('organization_name',$dept[0]['name'])->get();

        //案件追蹤
        $track = BusinessTrack::query()
                ->select('business_tracks.*','businesses.date','businesses.name','businesses.business_name','businesses.address','businesses.phone','business_case_details.numbers')
                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                ->where('business_tracks.user_id',Auth::user()->id)
                ->where('business_tracks.organization_name',$dept[0]['name'])
                ->where('business_tracks.statusTrack','Y')
                ->get();

        $trackNumberArray = array();
        foreach ($track as $key => $value) {
            if(!in_array($value->numbers, $trackNumberArray)){
                array_push($trackNumberArray, $value->numbers);
            }
        }

        //圖表-拜訪紀錄-不等於支援
        $chartArray = array();
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('user_id',Auth::user()->id)
                            ->get();

        foreach ($chart as $key => $value) {
            if(strpos($value->type,'支援') == false){ 
                $chartArray[] = array("id"=>$value->id);
            }
        }

        $noneHelpChartCount = count($chartArray);

        $chartArray = array();
        //圖表-拜訪紀錄-等於支援
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
                            ->where('organization_name',$dept[0]['name'])
                            ->where('user_id',Auth::user()->id)
                            ->get();

        foreach ($chart as $key => $value) {
            if(strpos($value->type,'支援') !== false){ 
                $chartArray[] = array("id",$value->id);
            }
        }

        $helpChartCount = count($chartArray);

        $businessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpChartCount),array("category"=>'非業務工作','column-1'=>$helpChartCount)];

        //圖表-拜訪紀錄-長條圖
        $chart = Business::whereYear('date','=',date('Y'))
                            ->whereMonth('date','=',date('m'))
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
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->where('businesses.type','!=','支援')
                            ->get();

        $noneHelpTrackBusinessCount = count($chart);

        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->where('businesses.type','=','支援')
                            ->get();

        $HelpTrackBusinessCount = count($chart);

        $TrackBusinessChartCount = [array("category"=>'業務工作','column-1'=>$noneHelpTrackBusinessCount),array("category"=>'非業務工作','column-1'=>$HelpTrackBusinessCount)];

        //圖表-追蹤數&案件結單狀況
       $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->get();
        // $chart = BusinessTrack::whereYear('updated_at','=',date('Y'))
        //                         ->whereMonth('updated_at','=',date('m'))
        //                         ->where('organization_name',$dept[0]['name'])
        //                         ->where('user_id',Auth::user()->id)
        //                         ->where('statusTrack','Y')
        //                         ->get();

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
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
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
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('businesses.date','=',date('Y'))
                                ->whereMonth('businesses.date','=',date('m'))
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

        return view('ht.Business.self.index',compact('organization','caseCount','visit','track','businessChartCount','businessChart','trackChartCount','TrackBusinessChartCount','resultChart','finishChartCount','money','newCustomChartCount','numberChart','numberTotalChart','allBusinessMonth','trackNumberArray'));
    }

    public function create(Organization $organization)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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

        $typeArray = array();
        foreach ($request->type as $key => $value) {

           array_push($typeArray, $value);
        }
        $type = implode(',', $typeArray);
        $business->type = $type;

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

        $typeArray = array();
        foreach ($request->type as $key => $value) {

           array_push($typeArray, $value);
        }
        $type = implode(',', $typeArray);
        $visit->type = $type;

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
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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

        $visit = Business::find($request->id);

        return view('ht.Business.self.visitEdit',compact('organization','caseCount','visit'));
    }

    public function trackEdit(Organization $organization,Request $request,$id)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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

        $org = Organization::where('id','!=','1')->get();

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

        $trackNotice = Notice::where('track_id',$id)->get();

        return view('ht.Business.self.trackEdit',compact('organization','caseCount','track','id','case_track','detail','org','trackNotice'));
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

        if($request->detailLength > 1){
            $delDetail = BusinessCaseDetail::where('business_track_id',$id)->delete();
        }

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

    public function sendMail(Organization $organization,Request $request)
    {
        $business = array();

        foreach ($request->id as $key => $value) {

            $busi = Business::find($value);

            if($key == 0){

                $type = str_replace(',', '、', $busi['type']);

               $business = array("status"=>200,"subject" => $busi['date']." ".$busi['business_name']."-業務拜訪紀錄","body" => $busi['date']." ".$busi['business_name']);

               $business["data"][] = array("type"=>$type,"name"=>$busi['name'],"content"=>$busi['content'],"time"=>$busi['time'],"other"=>$busi['other']);
            }
            else{
                $type = str_replace(',', '、', $busi['type']);

                $business["data"][] = array("type"=>$type,"name"=>$busi['name'],"content"=>$busi['content'],"time"=>$busi['time'],"other"=>$busi['other']);
            }

        }

        return $business;
    }

    public function trackExcel(Organization $organization,Request $request)
    {
        $today = date('Y-m-d');

        return (new BusinessDownloadExport)->search($request->id)->download($today.'案件追蹤表.xlsx');
    }

    public function trackWord(Organization $organization,Request $request)
    {

        //dd($request->all());
        $today = date('Y-m-d');

        // foreach ($request->id as $key => $value) {

        //     $business = BusinessTrack::query()
        //                 ->select('businesses.date','businesses.name','business_tracks.touch','businesses.city','businesses.area','businesses.address','businesses.address','businesses.phone','business_tracks.email','businesses.business_name')
        //                 ->leftjoin('businesses','business_tracks.business_id','=','businesses.id')
        //                 ->where('business_tracks.id',$value)
        //                 ->get();

            //foreach ($business as $k => $v) {
                //$date = $v['date'];

                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $section = $phpWord->addSection();
                $header2 = array('size' => 20, 'bold' => true);

                $header = $section->addHeader(); 

                $header->addImage(public_path('phpWordImg/logo.jpg'),array('width'=>120, 'height'=>58));

                $styleTable = array('borderSize' => 6, 'borderColor' => '999999','align' => 'right');
                $phpWord->addTableStyle('Header', $styleTable);
                $table = $header->addTable('Header');

                $largeFont = array('size'=>14);
                $table->addRow();
                $myCell1 = $table->addCell();
                $myCell1->addText('日期:'.explode('-',$today)[0]."年".explode('-',$today)[1]."月".explode('-',$today)[2]."日",$largeFont);
                $myCell1->addText('編號:',$largeFont);

                $table = $header->addTable(array('width' => 100 * 100, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
                $cell = $table->addRow()->addCell();
                $innerCell = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER))->addRow()->addCell();
                $innerCell->addText('報價單',$header2);

                $styleTable = array('borderSize' => 6, 'borderColor' => '999999');
                $phpWord->addTableStyle('Colspan Rowspan', $styleTable);
                $table = $section->addTable('Colspan Rowspan');

                $textSize = array('size' => 12, 'bold' => true,'valign' => 'center');
                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('公司寶號'),$textSize);
                $table->addCell(10000,array('gridSpan'=> 3))->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('承辦人'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('公司地址'),$textSize);
                $table->addCell(10000,array('gridSpan'=> 3))->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('電子郵件'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('公司電話'),$textSize);
                $table->addCell(5000)->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('傳真電話'),$textSize);
                $table->addCell(5000)->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('行動電話'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $styleTable = array('borderSize' => 10, 'borderColor' => '999999');
                $phpWord->addTableStyle('New Table', $styleTable);
                $table = $section->addTable('New Table');

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('報價單位'),$textSize);
                $table->addCell(10000,array('gridSpan'=> 3))->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('業務人員'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('公司地址'),$textSize);
                $table->addCell(10000,array('gridSpan'=> 3))->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('電子郵件'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('公司電話'),$textSize);
                $table->addCell(5000)->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('傳真電話'),$textSize);
                $table->addCell(5000)->addText(htmlspecialchars(''));
                $table->addCell(3000)->addText(htmlspecialchars('行動電話'),$textSize);
                $table->addCell(8000)->addText(htmlspecialchars(''));

                $section->addTextBreak(1);

                $styleTable = array('borderSize' => 10, 'borderColor' => '999999');
                $phpWord->addTableStyle('Detail Table', $styleTable);
                $table = $section->addTable('Detail Table');

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('項目'),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars('品名型號'),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars('單價'),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars('數量'),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars('合計'),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars('說明'),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(6000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(1800)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars(''),$textSize);
                $table->addCell(8000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('總價款'),$textSize);
                $table->addCell(11600,array('gridSpan'=> 4))->addText(htmlspecialchars('新台幣:兩萬三千零五十二元整'),$textSize);
                $table->addCell(4000)->addText(htmlspecialchars('NTD'),$textSize);
                $table->addCell(4000)->addText(htmlspecialchars('23052'),$textSize);

                $section->addTextBreak(1);

                $styleTable = array('borderSize' => 10, 'borderColor' => '999999');
                $phpWord->addTableStyle('Other Table', $styleTable);
                $table = $section->addTable('Other Table');

                $table->addRow(1200);
                $table->addCell(3000)->addText(htmlspecialchars('報價說明'),$textSize);
                $table->addCell(20000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(400);
                $table->addCell(3000)->addText(htmlspecialchars('付款條件'),$textSize);
                $table->addCell(20000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(800);
                $table->addCell(3000)->addText(htmlspecialchars('施工事項'),$textSize);
                $table->addCell(20000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(800);
                $table->addCell(3000)->addText(htmlspecialchars('保固期限'),$textSize);
                $table->addCell(20000,array('gridSpan'=> 2))->addText(htmlspecialchars(''),$textSize);

                $table->addRow(1100);
                $table->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('產品概述'),$textSize);
                $table->addCell(12000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),$textSize);
                $table->addCell(300)->addText(htmlspecialchars('希望安裝日期:                               月  日，  時至    時之間'),$textSize);

                $table->addRow(1100);
                $table->addCell(1000, array('vMerge' => 'continue'));
                $table->addCell(1000, array('vMerge' => 'continue'));
                $table->addCell(300)->addText('其他事項：');

                $table->addRow(1100);
                $table->addCell(1000, array('vMerge' => 'continue'));
                $table->addCell(1000, array('vMerge' => 'continue'));
                $table->addCell(300)->addText('如蒙惠顧 請蓋章回傳');

                //簽名處
                $section->addTextBreak(1);

                $styleTable = array('borderSize' => 10, 'borderColor' => '999999');
                $phpWord->addTableStyle('Sign Table', $styleTable);
                $table = $section->addTable('Sign Table');

                $textSize = array('size' => 12, 'bold' => true);
                $table->addRow(600);
                $table->addCell(1400)->addText(htmlspecialchars('業務人員'),$textSize);
                $table->addCell(1400)->addText(htmlspecialchars('業務主管'),$textSize);
                $table->addCell(2000)->addText(htmlspecialchars('服務站報價核章'),$textSize);

                $table->addRow(1200);
                $table->addCell(1400)->addText(htmlspecialchars(''));
                $table->addCell(1400)->addText(htmlspecialchars(''));
                $table->addCell(2000)->addText(htmlspecialchars(''));

               // $table->addCell()->addImage(public_path('img/checked.png'));
            //}
        //}



        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $phpWord->save($today.'_list.docx', 'Word2007', true);
    }

    public function visitSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $type = $request->type;
        $statusOpen = $request->statusOpen;
        $statusTrack = $request->statusTrack;

        $dept = Organization::where('id',$organization->id)->get();

        $visitTypeArray = array();
       
        $visitArray = Business::query()
        ->when($start, function ($query) use ($start,$end) {
            return $query->whereBetween('date',[$start,$end]);
        })
        ->when($statusOpen, function ($query) use ($statusOpen) {
            return $query->where('statusOpen',$statusOpen);
        })
        ->when($statusTrack, function ($query) use ($statusTrack) {
            return $query->where('statusTrack',$statusTrack);
        })
        ->where('user_id',Auth::user()->id)
        ->where('organization_name',$dept[0]['name'])
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
            ->where('business_tracks.user_id',Auth::user()->id)
            ->where('business_tracks.organization_name',$dept[0]['name'])
            ->where('business_tracks.statusTrack','Y')
            ->get();

        return $trackArray;
    }

    public function monthSearch(Organization $organization,Request $request)
    {
        $year = explode('-', $request->month)[0];
        $month = explode('-', $request->month)[1];

        $dept = Organization::where('id',$organization->id)->get();

        $chart = Business::whereYear('date','=',$year)
                            ->whereMonth('date','=',$month)
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

        //圖表-追蹤數&案件結單狀況
        $chart = BusinessTrack::query()
                            ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                            ->whereYear('businesses.date','=',date('Y'))
                            ->whereMonth('businesses.date','=',date('m'))
                            ->where('business_tracks.organization_name',$dept[0]['name'])
                            ->where('business_tracks.user_id',Auth::user()->id)
                            ->where('business_tracks.statusTrack','Y')
                            ->get();
        // $chart = BusinessTrack::whereYear('updated_at','=',$year)
        //                         ->whereMonth('updated_at','=',$month)
        //                         ->where('organization_name',$dept[0]['name'])
        //                         ->where('user_id',Auth::user()->id)
        //                         ->where('statusTrack','Y')
        //                         ->get();

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
                                ->whereYear('businesses.date','=',$year)
                                ->whereMonth('businesses.date','=',$month)
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
                            ->whereYear('businesses.date','=',$year)
                            ->whereMonth('businesses.date','=',$month)
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
                                ->leftjoin('businesses','businesses.id','=','business_tracks.business_id')
                                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                                ->whereYear('businesses.date','=',$year)
                                ->whereMonth('businesses.date','=',$month)
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

        return [$businessChart,$allBusinessMonth,$resultChart,$finishChartCount,$money,$newCustomChartCount,$numberChart,$numberTotalChart];
    }

    public function addNotice(Organization $organization,Request $request)
    {

        $dept = Organization::where('id',$organization->id)->get();

        $trackNoticeFind = Notice::where('track_id',$request->id)->get();

        if($trackNoticeFind->isNotEmpty()){

            $notice = Notice::find($trackNoticeFind[0]['id']);

            $notice->title = $request->title;
            $notice->content = $request->content;
            $notice->category = $request->category;
            if($request->category == '單次'){
                $notice->startTime = $request->startTimeOnce;
            }
            elseif($request->category == '每日'){
                $notice->startTime = $request->startTimeEveryDay;
            }
            if($request->category == '每週'){
                $notice->startTime = $request->startTimeEveryWeek;
            }
            if($request->category == '每月'){
                $notice->startTime = $request->startTimeEveryMonth;
            }

            $notice->week = $request->week;
            if($request->category == '每週'){
                $weekend = implode(',', $request->weekend);
                $weekendTime = implode(',', $request->weekendTime);

                $notice->weekend = $weekend;
                $notice->weekendTime = $weekendTime;
            }
            else{
                $notice->weekend = null;
                $notice->weekendTime = null;
            }

            //取得新增人的分公司/職稱 姓名
            if($request->meetingName == null){
                $notice->meeting = $dept[0]['name']."/".Auth::user()->job." ".Auth::user()->name;
            }
            else{
                $notice->meeting = $request->meetingName;
            }

            if($request->meetingToken == null){
                $notice->token = Auth::user()->token;
            }
            else{
               $notice->token = $request->meetingToken;
            }

            $notice->type = $request->type;
            $notice->other = $request->other;
            $notice->save();

            return redirect()->route('ht.Overview.notice.index',compact('organization'))->with('success','新增成功');
        }
        else{

            $notice = new Notice;
            $notice->organization_name = $dept[0]['name'];
            $notice->user_id = Auth::user()->id;
            $notice->track_id = $request->id;
            $notice->title = $request->title;
            $notice->content = $request->content;
            $notice->category = $request->category;
            if($request->category == '單次'){
                $notice->startTime = $request->startTimeOnce;
            }
            elseif($request->category == '每日'){
                $notice->startTime = $request->startTimeEveryDay;
            }
            if($request->category == '每週'){
                $notice->startTime = $request->startTimeEveryWeek;
            }
            if($request->category == '每月'){
                $notice->startTime = $request->startTimeEveryMonth;
            }

            $notice->week = $request->week;
            if($request->category == '每週'){
                $weekend = implode(',', $request->weekend);
                $weekendTime = implode(',', $request->weekendTime);

                $notice->weekend = $weekend;
                $notice->weekendTime = $weekendTime;
            }
            else{
                $notice->weekend = null;
                $notice->weekendTime = null;
            }

            //取得新增人的分公司/職稱 姓名
            if($request->meetingName == null){
                $notice->meeting = $dept[0]['name']."/".Auth::user()->job." ".Auth::user()->name;
            }
            else{
                $notice->meeting = $request->meetingName;
            }

            if($request->meetingToken == null){
                $notice->token = Auth::user()->token;
            }
            else{
               $notice->token = $request->meetingToken;
            }

            $notice->type = $request->type;
            $notice->other = $request->other;
            $notice->save();

            return redirect()->route('ht.Overview.notice.index',compact('organization'))->with('success','新增成功');
        }
    }
}
