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

        return view('ht.Performance.all.index',compact('organization','caseCount','performance','total','test','aaa'));
    }
}
