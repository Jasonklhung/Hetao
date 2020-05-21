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

        if(!isset($cycle)){
            $cycle = [];
        }

        $allAssign = array();

        $assign = CycleAssign::where('organization_name',$dept[0]['name'])->where('statusERP','N')->get();

        foreach ($assign as $key => $value) {
            array_push($allAssign, $value->kind);
        }

        //卡張總數
        $assignArray = array();

        foreach ($assign as $key => $value) {
            if(!in_array(explode('-', $value->kind)[0], $assignArray)){
                array_push($assignArray, explode('-', $value->kind)[0]);
            } 
        }

        $assignArrayCount = count($assignArray);

        //全部區域
        $areaArray = array();

        foreach ($cycle as $key => $value) {
            if(!in_array($value->AREA, $areaArray)){
                array_push($areaArray, $value->AREA);
            } 
        }

        //卡張總數
        $cycleArray = array();

        foreach ($cycle as $key => $value) {
            if(!in_array(explode('-', $value->KIND)[0], $cycleArray)){
                array_push($cycleArray, explode('-', $value->KIND)[0]);
            } 
        }

        $cycleArrayCount = count($cycleArray);

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

        //週期異動-轉單
        $assignTurn = CycleAssign::where('organization_name',$dept[0]['name'])->where('status','T')->where('statusERP','N')->get();

        //卡張總數
        $assignTurnArray = array();

        foreach ($assignTurn as $key => $value) {
            if(!in_array(explode('-', $value->kind)[0], $assignTurnArray)){
                array_push($assignTurnArray, explode('-', $value->kind)[0]);
            } 
        }

        $assignTurnArrayCount = count($assignTurnArray);

        return view('ht.Cycle.all.index',compact('organization','caseCount','cycle','deptUser','allAssign','assign','assignTurn','cycleArrayCount','areaArray','assignArrayCount','assignTurnArrayCount'));
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

    public function cycleReady(Organization $organization,Request $request)
    {

        $staff = User::find($request->staff);

        $cycle = CycleAssign::find($request->id);
        $cycle->staff = $staff['name'];
        $cycle->save();

        return array("status"=>200);
    }

    public function cycleTurn(Organization $organization,Request $request)
    {

        $staff = User::find($request->staff);

        $cycle = CycleAssign::find($request->id);
        $cycle->staff = $staff['name'];
        $cycle->save();

        return array("status"=>200);
    }

    public function cycleSearch(Organization $organization,Request $request)
    {
        //dd($request->all());
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $month = $request->month;
        $area = $request->area;

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

        $cycleSearchArray = array();

        if($startDate != null && $endDate != null && $area != null && $month != null){
            foreach ($cycle as $key => $value) {
                if($value->NXTDATE >= $startDate && $value->NXTDATE <= $endDate && $value->AREA == $area && explode('-',$value->NXTDATE)[0] == date('Y') && explode('-',$value->NXTDATE)[1] == $month){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate != null && $endDate != null && $area != null && $month == null){
            foreach ($cycle as $key => $value) {
                if($value->NXTDATE >= $startDate && $value->NXTDATE <= $endDate && $value->AREA == $area){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate != null && $endDate != null && $area == null && $month != null){
            foreach ($cycle as $key => $value) {
                if($value->NXTDATE >= $startDate && $value->NXTDATE <= $endDate && explode('-',$value->NXTDATE)[0] == date('Y') && explode('-',$value->NXTDATE)[1] == $month){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate == null && $endDate == null && $area != null && $month != null){
            foreach ($cycle as $key => $value) {
                if($value->AREA == $area && explode('-',$value->NXTDATE)[0] == date('Y') && explode('-',$value->NXTDATE)[1] == $month){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate == null && $endDate == null && $area == null && $month != null){
            foreach ($cycle as $key => $value) {
                if(explode('-',$value->NXTDATE)[1] == $month && explode('-',$value->NXTDATE)[0] == date('Y')){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate == null && $endDate == null && $area != null && $month == null){
            foreach ($cycle as $key => $value) {
                if($value->AREA == $area){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate != null && $endDate != null && $area == null && $month == null){
            foreach ($cycle as $key => $value) {
                if($value->NXTDATE >= $startDate && $value->NXTDATE <= $endDate){

                    $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
                }
            }
        }
        elseif($startDate == null && $endDate == null && $area == null && $month == null){
            foreach ($cycle as $key => $value) {

                $cycleSearchArray[] = array("KIND"=>$value->KIND,"CARDNO"=>$value->CARDNO,"CUSTKEY"=>$value->CUSTKEY,"TOUCH"=>$value->TOUCH,"COMTEL"=>$value->COMTEL,"LSTDATE"=>$value->LSTDATE,"NXTDATE"=>$value->NXTDATE,"CYCLE"=>$value->CYCLE,"AREA"=>$value->AREA,"HOMETEL"=>$value->HOMETEL,"MPHONE"=>$value->MPHONE,"MACHINE"=>$value->MACHINE,"PAYMENT"=>$value->PAYMENT,"CODE"=>$value->CODE,"NUM"=>$value->NUM,"PRICE"=>$value->PRICE,"MEMO"=>$value->MEMO);
            }
        }

        return $cycleSearchArray;
    }

    public function assignCardSearch(Organization $organization,Request $request)
    {
        //dd($request->all());
        $start = $request->startDate;
        $end = $request->endDate;
        $status = $request->status;
        $staff = $request->staff;

        $dept = Organization::where('id',$organization->id)->get();
        $user = User::find($staff);

        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])
                            ->when($start, function ($query) use ($start,$end) {
                                return $query->whereBetween('thisDate',[$start,$end]);
                            })
                            ->when($status, function ($query) use ($status) {
                                return $query->where('status',$status);
                            })
                            ->when($staff, function ($query) use ($staff,$user) {
                                return $query->where('staff',$user['name']);
                            })
                            ->where('statusERP','N')
                            ->get();

        //卡張總數
        $cycleArray = array();

        foreach ($cycle as $key => $value) {
            if(!in_array(explode('-', $value->kind)[0], $cycleArray)){
                array_push($cycleArray, explode('-', $value->kind)[0]);
            } 
        }

        $cycleArrayCount = count($cycleArray);

        return [$cycle,$cycleArrayCount];

    }

    public function turnCardSearch(Organization $organization,Request $request)
    {
        //dd($request->all());
        $start = $request->startDate;
        $end = $request->endDate;
        $month = $request->month;
        $area = $request->area;
        $staff = $request->staff;

        $dept = Organization::where('id',$organization->id)->get();
        $user = User::find($staff);

        $cycleArray = array();

        $cycle = CycleAssign::where('organization_name',$dept[0]['name'])
                            ->when($start, function ($query) use ($start,$end) {
                                return $query->whereBetween('thisDate',[$start,$end]);
                            })
                            ->when($area, function ($query) use ($area) {
                                 return $query->where('area',$area);
                            })
                            ->when($staff, function ($query) use ($staff,$user) {
                                 return $query->where('staff',$user['name']);
                            })
                            ->where('status','T')
                            ->where('statusERP','N')
                            ->get();

        if($month == null){

            $cycleArray = $cycle;

            //卡張總數
            $cycleCountArray = array();

            foreach ($cycleArray as $key => $value) {
                if(!in_array(explode('-', $value->kind)[0], $cycleCountArray)){
                    array_push($cycleCountArray, explode('-', $value->kind)[0]);
                } 
            }

            $cycleCount = count($cycleCountArray);
        }
        else{

            foreach ($cycle as $key => $value) {

                if(explode('-',$value->thisDate)[1] == $month && explode('-',$value->thisDate)[0] == date('Y')){
                    $cycleArray[] = array("id"=>$value->id,"organization_name"=>$value->organization_name,"kind"=>$value->kind,"custkey"=>$value->custkey,"touch"=>$value->touch,"companyTel"=>$value->companyTel,"lastDate"=>$value->lastDate,"thisDate"=>$value->thisDate,"cycle"=>$value->cycle,"area"=>$value->area,"staff"=>$value->staff,"homeTel"=>$value->homeTel,"mobile"=>$value->mobile,"machine"=>$value->machine,"payAddress"=>$value->payAddress,"productCode"=>$value->productCode,"productNum"=>$value->productNum,"productPrice"=>$value->productPrice,"other"=>$value->other,"turnReason"=>$value->turnReason,"status"=>$value->status,"statusERP"=>$value->statusERP,"created_at"=>$value->created_at,"updated_at"=>$value->id,"updated_at"=>$value->id);
                }
            }

            //卡張總數
            $cycleCountArray = array();

            foreach ($cycleArray as $key => $value) {
                if(!in_array(explode('-', $value->kind)[0], $cycleCountArray)){
                    array_push($cycleCountArray, explode('-', $value->kind)[0]);
                } 
            }

            $cycleCount = count($cycleCountArray);
        }

        return [$cycleArray,$cycleCount];
    }
}
