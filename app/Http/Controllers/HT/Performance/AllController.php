<?php

namespace App\Http\Controllers\HT\Performance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;

class AllController extends Controller
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

        //全站業績
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => "",
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $name = array();
        $total = array();
        $total = array();
        $aaa = array();
        $performanceArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $performance = $value;
            }
            else{
                $performance = [];
            }
        }

        foreach ($performance as $key => $value) {
            if(date('Y') == explode('-',$value->DATE)[0] && date('m') == explode('-',$value->DATE)[1]){
                $performanceArray[] = $value;
            }
        }

        if($performanceArray == null){
            $type = [];
            $name = [];
            $aaa = [];
            $test = [];
            $totalMoney = 0;
        }
        else{
            foreach ($performanceArray as $key => $value) {
                if(!in_array($value->TYPE, $type)){
                    array_push($type, $value->TYPE);
                }

                if(!in_array($value->NAME, $name)){
                    array_push($name, $value->NAME);
                }
            }

            foreach ($name as $kk => $vv) {

                foreach ($type as $k => $v) {

                    $total[$vv][$k]['mount'] = 0;
                    $total[$vv][$k]['money'] = 0;
                    $aaa[$vv][$v]['mount'] = 0;
                    $aaa[$vv][$v]['money'] = 0;

                    foreach ($performance as $key => $value) {
                       if($value->TYPE == $v && $value->NAME == $vv){
                            $total[$vv][$k]['mount'] += $value->MATE;
                            $total[$vv][$k]['money'] += $value->AMOUNT;
                            $aaa[$vv][$v]['mount'] += $value->MATE;
                            $aaa[$vv][$v]['money'] += $value->AMOUNT;
                        }
                    }
                }
            }

            foreach ($aaa as $key => $value) {
                $test = $value;
            }

            $totalMoney = 0;
            foreach ($total as $key => $value) {
                foreach ($value as $k => $v) {
                    $totalMoney += $v['money'];
                }
            }
        }


        return view('ht.Performance.all.index',compact('organization','caseCount','performance','total','test','aaa','totalMoney','type','name','performanceArray'));
    }

    public function performanceAllSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => "",
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $name = array();
        $total = array();
        $total = array();
        $aaa = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $performance = $value;
            }
        }

        if($start == null && $end == null){

            foreach ($performance as $key => $value) {
                if(!in_array($value->TYPE, $type)){
                    array_push($type, $value->TYPE);
                }

                if(!in_array($value->NAME, $name)){
                    array_push($name, $value->NAME);
                }
            }
        }
        else{

            foreach ($performance as $key => $value) {
                if($value->DATE >= $start && $value->DATE <= $end){
                    if(!in_array($value->TYPE, $type)){
                        array_push($type, $value->TYPE);
                    }
                }

                if(!in_array($value->NAME, $name)){
                    array_push($name, $value->NAME);
                }
            }
        }

        foreach ($name as $kk => $vv) {

            foreach ($type as $k => $v) {

                $total[$vv][$k]['mount'] = 0;
                $total[$vv][$k]['money'] = 0;
                $aaa[$vv][$v]['mount'] = 0;
                $aaa[$vv][$v]['money'] = 0;

                foreach ($performance as $key => $value) {
                   if($value->DATE >= $start && $value->DATE <= $end && $value->TYPE == $v && $value->NAME == $vv){
                        $total[$vv][$k]['mount'] += $value->MATE;
                        $total[$vv][$k]['money'] += $value->AMOUNT;
                        $aaa[$vv][$v]['mount'] += $value->MATE;
                        $aaa[$vv][$v]['money'] += $value->AMOUNT;
                    }
                }
            }
        }

        foreach ($aaa as $key => $value) {
            $test = $value;
        }

        $totalMoney = 0;
        foreach ($total as $key => $value) {
            foreach ($value as $k => $v) {
                $totalMoney += $v['money'];
            }
        }

        return [$total,$totalMoney,$test];
    }

    public function businessSearch(Organization $organization,Request $request)
    {
        //dd($request->all());

        $start = $request->start;
        $end = $request->end;
        $business = $request->business;
        $types = $request->type;

        //全站業績
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => "",
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $name = array();
        $total = array();
        $total = array();
        $aaa = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $performance = $value;
            }
            else{
                $performance = [];
            }
        }

        $businessArray = array();
        $busi = array();
        $category = array();

        foreach ($performance as $key => $value) {
            if($start != null && $end != null && $business != null && $types != null){
                if($value->DATE >= $start && $value->DATE <= $end && $value->NAME == $business && $value->TYPE == $types){
                    $businessArray[] = $value;
                }
            }
            elseif($start != null && $end != null && $business != null && $types == null){
                if($value->DATE >= $start && $value->DATE <= $end && $value->NAME == $business){
                    $businessArray[] = $value;
                }
            }
            elseif($start != null && $end != null && $business == null && $types != null){
                if($value->DATE >= $start && $value->DATE <= $end && $value->TYPE == $type){
                    $businessArray[] = $value;
                }
            }
            elseif($start != null && $end != null && $business == null && $types == null){
                if($value->DATE >= $start && $value->DATE <= $end){
                    $businessArray[] = $value;
                }
            }
            elseif($start == null && $end == null && $business != null && $types == null){
                if($value->NAME == $business){
                    $businessArray[] = $value;
                }
            }
            elseif($start == null && $end == null && $business == null && $types != null){
                if($value->TYPE == $type){
                    $businessArray[] = $value;
                }
            }
            elseif($start == null && $end == null && $business != null && $types != null){
                if($value->NAME == $business && $value->TYPE == $types){
                    $businessArray[] = $value;
                }
            }
            elseif($start == null && $end == null && $business == null && $types == null){
                $businessArray[] = $value;
            }
        }

        foreach ($businessArray as $key => $value) {
            if(!in_array($value->NAME,$busi)){
                array_push($busi, $value->NAME);
            }

            if(!in_array($value->TYPE,$category)){
                array_push($category, $value->TYPE);
            }
        }

        return [$businessArray,$busi,$category];
    }
}
