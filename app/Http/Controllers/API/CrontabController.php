<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Timeset;
use App\Department;

use Carbon\Carbon;
use GuzzleHttp\Client;

class CrontabController extends Controller
{
    public function reservationFinish(Request $request) //線上預約完成
    {
    	$setting = Timeset::where('name','線上預約完成推播時間')->where('status','Y')->get(); //取得全部時間設定

    	$time = Carbon::now()->format('H:i'); //取現在時間
    	$time = $time.':00'; //取現在時間

    	foreach ($setting as $key => $value) {
    		$date = Carbon::parse('-'.$value->days.' days')->format('Y-m-d');
    		$DEPT = Department::where('organization_id',$value->organization_id)->get();

    		if($time == $value->time){

    			$client = new \GuzzleHttp\Client();
    			$response = $client->post('http://60.251.216.90:8855/api_/work-push', [
    				'headers' => ['Content-Type' => 'application/json'],
    				'body' => json_encode([
    					'date' => '2019-05-07',//$date,
    					'DEPT' => 'H026',//$DEPT[0]->name
    				])
    			]);

    			$response = $response->getBody()->getContents();

    			$data = json_decode($response);

    			$countArray = array();

    			foreach ($data as $key => $value) {
    				if($key == 'data'){
    					$array = $value;

    					foreach ($array as $k => $v) {
    						if($v->owner == null || $v->owner == ''){
    							array_push($countArray,$v);
    						}
    					}
    				}
    			}
    		}
    	}

    	//return $time;
    }
}
