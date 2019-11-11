<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Timeset;
use App\Department;
use App\Activity;

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
    						$client = new \GuzzleHttp\Client();
                            $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/reservation-push.php', [
                               'headers' => ['Content-Type' => 'application/json'],
                               'body' => json_encode([
                                'to' => $v->custoken,
                                'date' => $v->time,
                                'address' => $v->add,
                                'type' => $v->work_type,
                                'name' => $v->owner,
                            ])
                           ]);
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
                            $client = new \GuzzleHttp\Client();
                            $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/reservation-push.php', [
                               'headers' => ['Content-Type' => 'application/json'],
                               'body' => json_encode([
                                'to' => $v->custoken,
                                'date' => $v->time,
                                'address' => $v->add,
                                'type' => $v->work_type,
                                'name' => $v->owner,
                            ])
                           ]);
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
                                $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/修改成滿意度調查推波php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'date' => $v->time,
                                    'address' => $v->add,
                                    'type' => $v->work_type,
                                    'name' => $v->owner,
                                ])
                             ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function supervisorAssign(Request $request)//////////////////////待重寫
    {
        $setting = Timeset::where('name','通知主管指派項目')->where('status','Y')->get(); //取得全部時間設定

        $time = Carbon::now()->format('H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($setting as $key => $value) {
            $date = Carbon::now()->format('Y-m-d');
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
                                $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/修改成滿意度調查推波php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'date' => $v->time,
                                    'address' => $v->add,
                                    'type' => $v->work_type,
                                    'name' => $v->owner,
                                ])
                             ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function activitiesPush(Request $request)
    {

    }
}