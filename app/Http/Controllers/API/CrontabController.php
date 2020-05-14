<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Timeset;
use App\Department;
use App\Activity;
use App\User;
use App\Notice;

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
                              $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/push/reservation-pushTwo.php', [
                                 'headers' => ['Content-Type' => 'application/json'],
                                 'body' => json_encode([
                                    'to' => $v->custoken,
                                    'owner' => $v->owner_token,
                                    'date' => $v->time,
                                    'address' => $v->add,
                                    'type' => $v->work_type,
                                    'name' => $v->owner,
                                    'custname' => $v->full_name,
                                    'mobile' => $v->mobile,
                                    'cust' => $v->name,
                                    'phone' => $DEPT[0]->phone,
                                    'case_id' => $v->id,
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
                                    'custname' => $v->full_name,
                                    'mobile' => $v->mobile,
                                    'cust' => $v->name,
                                    'phone' => $DEPT[0]->phone,
                                    'case_id' => $v->id,
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
                        'token' => $vv->token,//kk->token
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
                        'to' => $vv->token,//kk->token
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

    public function noticePush(Request $request)
    {
        $notice = Notice::all();

        $time = Carbon::now()->format('Y-m-d H:i'); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($notice as $key => $value) {
            if($value->category == '單次'){
                if($value->startTime == $time){
                    $meet = explode(',',$value->meeting);
                    $meetArray = array();
                    foreach ($meet as $k => $v) {
                        array_push($meetArray, explode(' ',$v)[1]);
                    }

                    $meetImp = implode('、', $meetArray);

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://api-tf.accunix.net/api/LINEBot/5dfafa8e/sendMessages', [
                       'headers' => ['Content-Type' => 'application/json'],
                       'body' => json_encode([
                        'user_token' => 'Ubfc65b7e5cc49c5d3b79350064ca5576',
                        'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$value->other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                    ])
                   ]);
                }
            }
        }
    }
}