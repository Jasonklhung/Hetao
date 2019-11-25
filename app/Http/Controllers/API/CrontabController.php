<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Timeset;
use App\Department;
use App\Activity;
use App\User;

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
    		$date = Carbon::parse('-'.$value->days.' days')->format('Y-m-d'); //預約完成後推播 所以要用減
    		$DEPT = Department::where('organization_id',$value->organization_id)->get(); //取得部門代號

    		if($time == $value->time){ //現在時間 = 設定時間

    			$client = new \GuzzleHttp\Client();
    			$response = $client->post('http://60.251.216.90:8855/api_/work-push', [
    				'headers' => ['Content-Type' => 'application/json'],
    				'body' => json_encode([
    					'date' => $date,//$date,
    					'DEPT' => $DEPT[0]->name,//$DEPT[0]->name
    				])
    			]);

    			$response = $response->getBody()->getContents();

    			$data = json_decode($response);

    			foreach ($data as $key => $value) {
    				if($key == 'data'){
    					$array = $value;

    					foreach ($array as $k => $v) {
                            if($v->status != 'T'){
                              $client = new \GuzzleHttp\Client();
                              $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/reservation-push.php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'date' => $v->time,
                                    'address' => $v->add,
                                    'type' => $v->work_type,
                                    'name' => $v->owner,
                                    'mobile'=> $v->mobile,
                                ])
                             ]);
                          }
                        }
                    }
                }
    		}
    	}
    }

    public function reservationPreviousDay(Request $request)
    {
        $setting = Timeset::where('name','預約前一日通知推播時間')->where('status','Y')->get(); //取得全部時間設定

        $time = Carbon::now()->format('H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($setting as $key => $value) {
            $date = Carbon::parse('+'.$value->days.' days')->format('Y-m-d'); //預約完成後推播 所以要用減
            $DEPT = Department::where('organization_id',$value->organization_id)->get(); //取得部門代號

            if($time == $value->time){ //現在時間 = 設定時間

                $client = new \GuzzleHttp\Client();
                $response = $client->post('http://60.251.216.90:8855/api_/work-push', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'date' => $date,//$date,
                        'DEPT' => $DEPT[0]->name,//$DEPT[0]->name
                    ])
                ]);

                $response = $response->getBody()->getContents();

                $data = json_decode($response);

                foreach ($data as $key => $value) {
                    if($key == 'data'){
                        $array = $value;

                        foreach ($array as $k => $v) {
                            if($v->status != 'T'){
                                $client = new \GuzzleHttp\Client();
                                $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/reservation-pushTwo.php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'owner' => $v->owner_token,
                                    'date' => $v->time,
                                    'address' => $v->add,
                                    'type' => $v->work_type,
                                    'name' => $v->owner,
                                    'custname' => $v->name,
                                    'mobile' => $v->mobile,
                                ])
                             ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function satisfactionPush(Request $request)
    {
        $setting = Timeset::where('name','滿意度調查推播時間')->where('status','Y')->get(); //取得全部時間設定

        $time = Carbon::now()->format('H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($setting as $key => $value) {
            $date = Carbon::parse('-'.$value->days.' days')->format('Y-m-d'); //預約完成後推播 所以要用減
            $DEPT = Department::where('organization_id',$value->organization_id)->get(); //取得部門代號

            if($time == $value->time){ //現在時間 = 設定時間

                $client = new \GuzzleHttp\Client();
                $response = $client->post('http://60.251.216.90:8855/api_/work-push', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'date' => $date,//$date,
                        'DEPT' => $DEPT[0]->name,//$DEPT[0]->name
                    ])
                ]);

                $response = $response->getBody()->getContents();

                $data = json_decode($response);

                foreach ($data as $key => $value) {
                    if($key == 'data'){
                        $array = $value;

                        foreach ($array as $k => $v) {
                            if($v->status == 'T'){
                                $client = new \GuzzleHttp\Client();
                                $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/satisfaction-push.php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'date' => $v->time,
                                    'type' => $v->work_type,
                                    'case_id'=> $v->id,
                                ])
                             ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function supervisorAssign(Request $request)
    {
        $setting = Timeset::where('name','通知主管指派項目')->where('status','Y')->get(); //取得全部時間設定

        $time = Carbon::now()->format('H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        $result = array();

        foreach ($setting as $key => $value) {
            $date = Carbon::now()->format('Y-m-d');
            $DEPT = Department::where('organization_id',$value->organization_id)->get(); //取得部門代號
            $supervisor = User::where('organization_id',$value->organization_id)->where('job','主管')->get();

            if($time == $value->time){ //現在時間 = 設定時間
                foreach ($supervisor as $kk => $vv) {
                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
                        'headers' => ['Content-Type' => 'application/json'],
                        'body' => json_encode([
                        'token' => $kk->token,//kk->token
                        'DEPT' =>  $DEPT[0]->name,//$DEPT[0]->name
                        ])
                    ]);

                    $response = $response->getBody()->getContents();

                    $data = json_decode($response);

                    $result = array();

                    foreach ($data as $key => $value) {
                        if($key == 'data'){
                            $array = $value;

                            foreach ($array as $k => $v) {
                                if($v->owner == '' || $v->owner == null || $v->status == 'R'){
                                    array_push($result,$v);
                                }
                            }
                        }
                    }
                    $count = count($result);

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/supervisorAssign-push.php', [
                       'headers' => ['Content-Type' => 'application/json'],
                       'body' => json_encode([
                        'to' => $kk->token,//kk->token
                        'count' => $count,
                    ])
                   ]);
                }      
            }
        }
    }

    public function activitiesPush(Request $request)
    {
        $act = Activity::all();

        $time = Carbon::now()->format('Y-m-d H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($act as $key => $value) {
            if($time == $value->pushDate){
                $token = User::find($value->owner)->token;

                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/activitiesPush.php', [
                 'headers' => ['Content-Type' => 'application/json'],
                 'body' => json_encode([
                        'to' => $token,
                        'multi' => $value->meetingToken,
                        'title' => $value->title,
                        'start' => $value->start,
                        'end' => $value->end,
                        'position' => $value->position,
                        'meeting' => $value->meeting,
                        'description' => $value->description,
                    ])
                ]);
            }
        }
    }
}