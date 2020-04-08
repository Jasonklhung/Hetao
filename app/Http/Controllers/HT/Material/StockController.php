<?php

namespace App\Http\Controllers\HT\Material;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;

class StockController extends Controller
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

        return view('ht.Material.stock.index',compact('organization','caseCount'));
    }
}
