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
use App\Account;

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

        $cycleFinishArray = array();
        foreach ($cycleFinish as $key => $value) {
            if(!in_array(explode('-',$value->kind)[0], $cycleFinishArray)){
                array_push($cycleFinishArray, explode('-',$value->kind)[0]);
            }
        }

        $cycleFinishArrayCount = count($cycleFinishArray);

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

        return view('ht.Cycle.self.index',compact('organization','caseCount','cycle','cycleNext','cycleS','cycleF','cycleT','cycleCategory','cycleArrayCount','cycleFinishArrayCount'));
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
        $start = $request->start;
        $end = $request->end;

        $dept = Organization::where('id',$organization->id)->get();

        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])
                            ->where('staff',Auth::user()->name)
                            ->where('status','S')
                            ->when($start, function ($query) use ($start,$end) {
                                return $query->whereBetween('thisDate',[$start,$end]);
                            })
                            ->get();

        $cycleArray = array();
        foreach ($cycle as $key => $value) {
            if(!in_array(explode('-',$value->kind)[0], $cycleArray)){
                array_push($cycleArray, explode('-',$value->kind)[0]);
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

        $cycleFinish = CycleAssign::where('organization_name',$dept[0]['name'])
                                    ->where('staff',Auth::user()->name)
                                    ->where('status','=','F')
                                    ->when($start, function ($query) use ($start,$end) {
                                        return $query->whereBetween('thisDate',[$start,$end]);
                                    })
                                    ->when($code, function ($query) use ($code) {
                                        return $query->where('productCode',$code);
                                    })
                                    ->get();

        $cycleArray = array();
        foreach ($cycleFinish as $key => $value) {
            if(!in_array(explode('-',$value->kind)[0], $cycleArray)){
                array_push($cycleArray, explode('-',$value->kind)[0]);
            }
        }

        $cycleArrayCount = count($cycleArray);

        foreach ($cycleFinish as $key => $value) {

            $cycleNextArray[] = array("kind"=>$value->kind,"custkey"=>$value->custkey,"touch"=>$value->touch,"companyTel"=>$value->companyTel,"finishDate"=>$value->thisDate,"nextDate"=>Carbon::parse($value->thisDate)->addDays($value->cycle)->format('Y-m-d'),"cycle"=>$value->cycle,"area"=>$value->area,"staff"=>$value->staff,"homeTel"=>$value->homeTel,"mobile"=>$value->mobile,"machine"=>$value->machine,"payAddress"=>$value->payAddress,"productCode"=>$value->productCode,"productNum"=>$value->productNum,"productPrice"=>$value->productPrice,"other"=>$value->other);
        }

        return [$cycleNextArray,$cycleArrayCount];
    }

    public function cycleNotice(Organization $organization,Request $request)
    {
        $cycle = CycleAssign::find($request->id);
        $custkey = $request->custkey;
        $account = Account::where('cuskey',$custkey)->get();
        $dept = Organization::where('id',$organization->id)->get();

        if($account->isNotEmpty()){

            //週期通知
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/message/push', [
               'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
               'body' => json_encode([
                'to' => $v->owner_token,
                'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您工單通知","contents":{"type":"flex","altText":"週期服務通知，賀眾牌 關心您！","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"週期提醒","weight":"bold","color":"#1D77B4","size":"sm"},{"type":"text","text":"'.$account[0]['name'].'","color":"#555555","weight":"bold","offsetTop":"3px","size":"lg"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"您好！","flex":1,"size":"md","wrap":true}]},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"預計於:","size":"md","flex":2},{"type":"text","size":"md","color":"#AE0000","wrap":true,"flex":5,"text":"'.$cycle->thisDate.'","weight":"bold"}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"將有專人進行週期性服務，謝謝。","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"客服專線：","wrap":true,"size":"md","flex":1},{"type":"text","text":"'.$dept[0]['phone'].'","size":"md","color":"#1D77B4","weight":"bold","flex":2,"action":{"type":"uri","label":"action","uri":"http://linecorp.com/"}}]},{"type":"filler"},{"type":"filler"}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"sm","contents":[{"type":"text","text":"賀眾牌 關心您！","size":"lg","color":"#1D77B4","weight":"bold","offsetTop":"2px","align":"center"}]}]},"styles":{"footer":{"separator":true}}}}}]')
            ])
           ]);
        }
        else{

            return array('status'=>404);
        }
    }
}
