<?php

namespace App\Http\Controllers\HT\Performance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;

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

        //個人業績
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => Auth::user()->name,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $total = array();
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
            $totalMoney = 0;
        }
        else{
            foreach ($performance as $key => $value) {
                if(!in_array($value->TYPE, $type)){
                    array_push($type, $value->TYPE);
                }
            }


            foreach ($type as $k => $v) {

                $total[$v]['mount'] = 0;
                $total[$v]['money'] = 0;

                foreach ($performance as $key => $value) {
                    if($value->TYPE == $v){
                        $total[$v]['mount'] += $value->MATE;
                        $total[$v]['money'] += $value->AMOUNT;
                    }
                }
            }

            $totalMoney = 0;
            foreach ($total as $key => $value) {
                $totalMoney += $value['money'];
            }
        }

        return view('ht.Performance.self.index',compact('organization','caseCount','performance','total','totalMoney','type','performanceArray'));
    }

    public function performanceSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        //個人業績
        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => Auth::user()->name,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $total = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $performance = $value;
            }
            else{
                $performance = [];
            }
        }

        foreach ($performance as $key => $value) {
            if($value->DATE >= $start && $value->DATE <= $end){
                if(!in_array($value->TYPE, $type)){
                    array_push($type, $value->TYPE);
                }
            }
        }


        foreach ($type as $k => $v) {

            $total[$v]['mount'] = 0;
            $total[$v]['money'] = 0;

            foreach ($performance as $key => $value) {
               if($value->TYPE == $v){
                    $total[$v]['mount'] += $value->MATE;
                    $total[$v]['money'] += $value->AMOUNT;
                }
            }
        }

        $totalMoney = 0;
        foreach ($total as $key => $value) {
            $totalMoney += $value['money'];
        }

        return [$total,$totalMoney];
    }

    public function categorySearch(Organization $organization,Request $request)
    {
        $category = $request->category;

        $dept = Organization::where('id',$organization->id)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-sales', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'FAMILY' => Auth::user()->name,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $type = array();
        $total = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $performance = $value;
            }
            else{
                $performance = [];
            }
        }

        $typeArray = array();

        foreach ($performance as $key => $value) {
            
            if($value->TYPE == $category){
                $typeArray[] = $value;
            }
        }

        
        return $typeArray;
    }
}
