<?php

namespace App\Http\Controllers\HT\Material;

set_time_limit(0);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\MaterialStock;
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

    public function stockApi(Organization $organization)
    {
        $dept = Organization::whereNotIn('id',['1','2'])->get();

        foreach ($dept as $keys => $values) {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/get-mat', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'DEPT' => $values->name
                ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            if($data){
                foreach ($data as $key => $value) {
                    if($key == 'data'){
                        $array = $value;

                        foreach ($array as $k => $v) {
                            $materials_number = $v->CODE;
                            $materials_spec = $v->DESCRIBE;
                            $machine_number = $v->MACNSERAL->MACNSERAL;
                            $machine_number = implode(',', $machine_number);
                            $suppkey = $v->SUPPKEY;
                            $quantity = $v->HAND1;

                            $stock = new MaterialStock;
                            $stock->organization_name = $values->name;
                            $stock->materials_number = $materials_number;
                            $stock->materials_spec = $materials_spec;
                            $stock->machine_number = $machine_number;
                            $stock->suppkey = $suppkey;
                            $stock->quantity = $quantity;

                            $stock->save();
                        }
                    }
                }
            }
        }
    }
}
