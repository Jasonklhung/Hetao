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
        }

        foreach ($performance as $key => $value) {
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

        return view('ht.Performance.all.index',compact('organization','caseCount','performance','total','test','aaa','totalMoney','type','name'));
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

        return [$total,$totalMoney,$test];
    }

    public function businessSearch(Organization $organization,Request $request)
    {
        dd($request->all());

        $business = $request->business;
        $type = $request->type;

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
        }

        $businessArray = array();

        foreach ($performance as $key => $value) {
            if($business != null && $type != null){
                if($value->NAME == $business && $value->TYPE == $type){
                    $businessArray[] = $value;
                }
            }
            elseif($business != null && $type == null){
                if($value->NAME == $business){
                    $businessArray[] = $value;
                }
            }
            elseif($business == null && $type != null){
                if($value->TYPE == $type){
                    $businessArray[] = $value;
                }
            }
        }

        return $businessArray;
    }
}
