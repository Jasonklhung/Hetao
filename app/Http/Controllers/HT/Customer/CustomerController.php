<?php

namespace App\Http\Controllers\HT\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;


class CustomerController extends Controller
{
    public function index(Organization $organization)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工' || $job == '業務'){
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

        return view('ht.Customer.index',compact('organization','caseCount'));
    }

    public function show(Organization $organization, $id,$type)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工' || $job == '業務'){
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

        //客戶代碼 = id
        $custkey = $id;

        //基本資料
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'CUST',
                "CUSTKEY"  => $id,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $info = $value;
            }
        }

        //交易資料
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'HISSAL',
                "CUSTKEY"  => $id,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $tradeStaff = array();
        $tradeCode = array();


        foreach ($data as $key => $value) {
            if($key == 'data'){
                $trade = $value;
            }
        }

        if(!isset($trade)){
             $trade = [];
        }

        foreach ($trade as $key => $value) {
            if(!in_array($value->FAMILY, $tradeStaff)){
                array_push($tradeStaff, $value->FAMILY);
            }
        }

        foreach ($trade as $key => $value) {
            if(!in_array($value->CODE, $tradeCode)){
                array_push($tradeCode, $value->CODE);
            }
        }

        //應收帳款
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'ARAP',
                "CUSTKEY"  => $id,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $arapStaff = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $arap = $value;
            }
            else{
                $arap = [];
            }
        }

        foreach ($arap as $key => $value) {
            if(!in_array($value->FAMILY, $arapStaff)){
                array_push($arapStaff, $value->FAMILY);
            }
        }

        //週期循環
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'CLIENTS',
                "CUSTKEY"  => $id,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $cycle = $value;
            }
            else{
                $cycle = [];
            }
        }

        return view('ht.Customer.show',compact('organization','caseCount','custkey','info','trade','arap','cycle','tradeStaff','tradeCode','arapStaff'));
    }

    public function search(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-cust', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => $request->type,
                "KEY"  => $request->key,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $customerArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $customerArray = $value;
            }
        }

        return $customerArray;
    }

    public function tradeSearch(Organization $organization,Request $request)
    {
        // dd($request->all());

        $dept = Organization::where('id',$organization->id)->get();

        $start = $request->start;
        $end = $request->end;
        $staff = $request->staff;
        $code = $request->code;
        $custkey = $request->custkey;

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'HISSAL',
                "CUSTKEY"  => $custkey,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $trade = array();
        $tradeArray = array();

        $data = json_decode($response);
        foreach ($data as $key => $value) {
            if($key == 'data'){
                $trade = $value;
            }
        }

        if($start != null && $end != null && $staff != null && $code != null){
            foreach ($trade as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end && $value->FAMILY == $staff && $value->CODE == $code){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start != null && $end != null && $staff != null && $code == null){
            foreach ($trade as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end && $value->FAMILY == $staff){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start != null && $end != null && $staff == null && $code != null){
            foreach ($trade as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end && $value->CODE == $code){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start != null && $end != null && $staff == null && $code == null){
            foreach ($trade as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $staff != null && $code != null){
            foreach ($trade as $key => $value) {
                if($value->FAMILY == $staff && $value->CODE == $code){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $staff == null && $code != null){
            foreach ($trade as $key => $value) {
                if($value->CODE == $code){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $staff != null && $code == null){
            foreach ($trade as $key => $value) {
                if($value->FAMILY == $staff){
                    $tradeArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $staff == null && $code == null){
            foreach ($trade as $key => $value) {
                $tradeArray[] = $value;
            }
        }

        return $tradeArray;

    }

    public function arapSearch(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $start = $request->start;
        $end = $request->end;
        $staff = $request->staff;
        $custkey = $request->custkey;

        //應收帳款
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'ARAP',
                "CUSTKEY"  => $custkey,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $arap = array();
        $arapArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $arap = $value;
            }
            else{
                $arap = [];
            }
        }

        if($start != null && $end != null && $staff != null){
            foreach ($arap as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end && $value->FAMILY == $staff){
                    $arapArray[] = $value;
                }
            }
        }
        elseif($start != null && $end != null && $staff == null){
            foreach ($arap as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end){
                    $arapArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null && $staff != null){
            foreach ($arap as $key => $value) {
                if($value->FAMILY == $staff){
                    $arapArray[] = $value;
                }
            }
        }
        if($start == null && $end == null && $staff == null){
            foreach ($arap as $key => $value) {
                $arapArray[] = $value;
            }
        }

        return $arapArray;
    }

    public function cycleSearch(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $start = $request->start;
        $end = $request->end;
        $custkey = $request->custkey;

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/search-info', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'DEPT' => $dept[0]['name'],
                'TYPE' => 'CLIENTS',
                "CUSTKEY"  => $custkey,
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $cycle = array();
        $cycleArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $cycle = $value;
            }
            else{
                $cycle = [];
            }
        }

        if($start != null && $end != null){
            foreach ($cycle as $key => $value) {
                if($value->BGNDATE >= $start && $value->BGNDATE <= $end){
                    $cycleArray[] = $value;
                }
            }
        }
        elseif($start == null && $end == null){
            foreach ($cycle as $key => $value) {
                $cycleArray[] = $value;
            }
        }

        return $cycleArray;
    }
}
