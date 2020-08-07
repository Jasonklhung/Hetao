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
        $turnDate = $request->date;

    	$setting = Timeset::where('name','線上預約完成推播時間')->where('status','Y')->get(); //取得全部時間設定

    	//$time = Carbon::now()->format('H:i'); //取現在時間
        $time =  date("H:i",$turnDate); //取現在時間
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
                                if(empty($v->custoken)){    //只推播員工

                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->owner_token,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您工單通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"工單通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 :","size":"md","flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"客戶名稱 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->full_name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡電話 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->mobile.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"tel:'.$v->mobile.'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"行程回報 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往行程回報","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://liff.line.me/1614487647-Dv93jRgq"}}]}]}]}}}]')
                                    ])
                                   ]);
                                }
                                else{

                                    //推播員工
                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->owner_token,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您工單通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"工單通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 :","size":"md","flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"客戶名稱 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->full_name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡電話 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->mobile.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"tel:'.$v->mobile.'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"行程回報 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往行程回報","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://liff.line.me/1614487647-Dv93jRgq"}}]}]}]}}}]')
                                    ])
                                   ]);

                                    //推播客戶
                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->custoken,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您服務通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"服務通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"'.$v->full_name.' 您好!","size":"md","wrap":true,"weight":"bold"}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"以下為本次的服務資訊 : ","size":"md","wrap":true,"weight":"bold"}]},{"type":"separator","margin":"md"},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->owner.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"叫修紀錄 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往叫修紀錄","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://bot-event.accunix.net/line/1614487647/liff/reservation2.php?user_token='.$v->custoken.'&case_id='.$v->id.'"}}]},{"type":"separator","margin":"md"},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"如有問題請撥打 : ","size":"md","wrap":true},{"type":"text","text":"'.$DEPT[0]->phone.'","color":"#003C9D","size":"md","wrap":true,"action":{"type":"uri","uri":"tel:'.$DEPT[0]->phone.'"}}]}]}]}}}]')
                                    ])
                                   ]);
                                }
                            }
                        }
                    }
                }
    		}
    	}
    }

    public function reservationPreviousDay(Request $request)
    {
        $turnDate = $request->date;

        $setting = Timeset::where('name','預約前一日通知推播時間')->where('status','Y')->get(); //取得全部時間設定

        //$time = Carbon::now()->format('H:i'); //取現在時間
        $time =  date("H:i",$turnDate); //取現在時間
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

                                if(empty($v->custoken)){    //只推播員工

                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->owner_token,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您工單通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"工單通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 :","size":"md","flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"客戶名稱 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->full_name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡電話 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->mobile.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"tel:'.$v->mobile.'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"行程回報 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往行程回報","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://liff.line.me/1614487647-Dv93jRgq"}}]}]}]}}}]')
                                    ])
                                   ]);
                                }
                                else{

                                    //推播員工
                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->owner_token,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您工單通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"工單通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 :","size":"md","flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"客戶名稱 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->full_name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->name.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡電話 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->mobile.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"tel:'.$v->mobile.'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"聯絡地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"行程回報 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往行程回報","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://liff.line.me/1614487647-Dv93jRgq"}}]}]}]}}}]')
                                    ])
                                   ]);

                                    //推播客戶
                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $v->custoken,//[$v->owner_token],
                                        'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您服務通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"服務通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"'.$v->full_name.' 您好!","size":"md","wrap":true,"weight":"bold"}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"以下為本次的服務資訊 : ","size":"md","wrap":true,"weight":"bold"}]},{"type":"separator","margin":"md"},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務日期 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->time.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務項目 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->work_type.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務人員 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->owner.'","size":"md","wrap":true,"flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"服務地址 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"'.$v->add.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($v->add).'"}}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"叫修紀錄 : ","size":"md","wrap":true,"flex":2},{"type":"text","text":"點此前往叫修紀錄","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://bot-event.accunix.net/line/1614487647/liff/reservation2.php?user_token='.$v->custoken.'&case_id='.$v->id.'"}}]},{"type":"separator","margin":"md"},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"如有問題請撥打 : ","size":"md","wrap":true},{"type":"text","text":"'.$DEPT[0]->phone.'","color":"#003C9D","size":"md","wrap":true,"action":{"type":"uri","uri":"tel:'.$DEPT[0]->phone.'"}}]}]}]}}}]')
                                    ])
                                   ]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function satisfactionPush(Request $request)
    {
        $turnDate = $request->date;

        $setting = Timeset::where('name','滿意度調查推播時間')->where('status','Y')->get(); //取得全部時間設定

        //$time = Carbon::now()->format('H:i'); //取現在時間
        $time =  date("H:i",$turnDate); //取現在時間
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
                                $response = $client->post('https://api.line.me/v2/bot/message/push', [
                                    'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                    'body' => json_encode([
                                    'to' => $v->custoken,
                                    'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您滿意度問卷","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"滿意度問卷","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"親愛的客戶 您好:","size":"md","wrap":true,"weight":"bold"}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"為了提供您更好的品質與服務,請您\n填寫對於'.$v->time.' [ '.$v->work_type.' ] 服務\n的滿意度問卷,謝謝!","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"點此前往問卷填寫","align":"center","size":"md","color":"#003C9D","wrap":true,"action":{"type":"uri","uri":"https://bot-event.accunix.net/line/1614487647/liff/satisfaction.php?token='.$v->custoken.'&case_id='.$v->id.'"}}]}]}]}}}]')
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
        $turnDate = $request->date;

        $setting = Timeset::where('name','通知主管指派項目')->where('status','Y')->get(); //取得全部時間設定

        //$time = Carbon::now()->format('H:i'); //取現在時間
        $time =  date("H:i",$turnDate); //取現在時間
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
                    $response = $client->post('https://api.line.me/v2/bot/message/push', [
                        'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                        'body' => json_encode([
                            'to' => $vv->token,
                            'messages' =>json_decode('[{"type":"flex","altText":"已傳送待派工通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"待派工通知","align":"center","size":"xl","weight":"bold"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":" ","size":"md","wrap":true}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"親愛的主管 您好:","size":"md","wrap":true,"weight":"bold"}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"'.date('Y-m-d').'尚有'.$count.'張待指派工單,\n請您詳閱,謝謝!","size":"md","color":"#003C9D","wrap":true,"action":{"type":"uri","uri":"https://liff.line.me/1614487647-MaGq9b2e"}}]}]}]}}}]')
                        ])
                    ]);
                }      
            }
        }
    }

    public function activitiesPush(Request $request)
    {
        $act = Activity::all();

        $turnDate = $request->date;

        //$time = Carbon::now()->format('H:i'); //取現在時間
        $time =  date("Y-m-d H:i",$turnDate); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($act as $key => $value) {
            if($time == $value->pushDate){

                $tokenArray = explode(',', $value->meetingToken);

                $res = explode(',', $value->meeting);
                $test = array();

                foreach ($res as $k => $v) {
                    array_push($test, substr(explode('/', $v)[1] , 6));
                }

                $final = implode(',', $test);

                if(explode(' ', $value->start)[1] == "00:00:00" && explode(' ', $value->end)[1] == '00:00:00'){

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                        'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                        'body' => json_encode([
                            'to' => $tokenArray,
                            'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您活動通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"活動通知","weight":"bold","align":"center","size":"xl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"名稱  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$value->title.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"日期  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.explode(' ', $value->start)[0].'~'.''.explode(' ', $value->end)[0].'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"時間  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"整天","size":"md","color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"人員  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$final.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"備註  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$value->description.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"位置 : ","size":"md","wrap":true,"flex":1},{"type":"text","text":"'.$value->position.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($value->position).'"}}]}]}]}}}]')
                        ])
                    ]);
                }
                else{

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                        'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                        'body' => json_encode([
                            'to' => $tokenArray,
                            'messages' =>json_decode('[{"type":"flex","altText":"已傳送給您活動通知","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"活動通知","weight":"bold","align":"center","size":"xl","margin":"md"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"名稱  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$value->title.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"日期  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.explode(' ', $value->start)[0].'~'.''.explode(' ', $value->end)[0].'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"時間  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.explode(' ', $value->start)[1].'~'.''.explode(' ', $value->end)[1].'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"人員  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$final.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"備註  :  ","size":"md","color":"#111111","flex":1},{"type":"text","text":"'.$value->description.'","size":"md","wrap":true,"color":"#111111","flex":4}]},{"type":"box","layout":"horizontal","contents":[{"type":"text","text":"位置 : ","size":"md","wrap":true,"flex":1},{"type":"text","text":"'.$value->position.'","color":"#003C9D","size":"md","wrap":true,"flex":4,"action":{"type":"uri","uri":"https://maps.apple.com/?q='.urlencode($value->position).'"}}]}]}]}}}]')
                        ])
                    ]);
                }
            }
        }
    }

    public function noticePush(Request $request)
    {
        $turnDate = $request->date;

        $notice = Notice::all();

        $date =  date("Y-m-d",$turnDate); //取現在日期
        $day =  date("d",$turnDate); //取現在日

        $dateTime =  date("Y-m-d H:i",$turnDate); //取現在日期+時間
        $dateTime = $dateTime.':00'; //取現在日期+時間

        $time =  date("H:i",$turnDate); //取現在時間
        $time = $time.':00'; //取現在時間

        foreach ($notice as $key => $value) {
            if($value->category == '單次'){
                if($value->startTime == $dateTime){

                    $meet = explode(',',$value->meeting);   //取得所有通知人名
                    $meetArray = array();
                    foreach ($meet as $k => $v) {
                        array_push($meetArray, explode(' ',$v)[1]);
                    }

                    $meetImp = implode('、', $meetArray);    //人名、隔開

                    $other = $value->other;
                    if($other == null){
                        $other = '無';
                    }

                    $tokenArray = explode(',',$value->token);

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                       'body' => json_encode([
                        'to' => $tokenArray,
                        'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                    ])
                   ]);
                }
            }
            elseif($value->category == '每日'){
                if($date >= explode(' ',$value->startTime)[0]  && explode(' ',$value->startTime)[1] == $time){

                    $meet = explode(',',$value->meeting);   //取得所有通知人名
                    $meetArray = array();
                    foreach ($meet as $k => $v) {
                        array_push($meetArray, explode(' ',$v)[1]);
                    }

                    $meetImp = implode('、', $meetArray);    //人名、隔開

                    $other = $value->other;
                    if($other == null){
                        $other = '無';
                    }

                    $tokenArray = explode(',',$value->token);

                    $client = new \GuzzleHttp\Client();
                    $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                       'body' => json_encode([
                        'to' => $tokenArray,
                        'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                    ])
                   ]);
                }
            }
            elseif($value->category == '每週'){
                if($value->week == '1'){

                    $push = 'N';
                    $week = Carbon::now()->dayOfWeek;   //取得當天星期幾

                    if($week == 0){
                        $weekDay = '星期日';
                    }
                    elseif($week == 1){
                        $weekDay = '星期一';
                    }
                    elseif($week == 2){
                        $weekDay = '星期二';
                    }
                    elseif($week == 3){
                        $weekDay = '星期三';
                    }
                    elseif($week == 4){
                        $weekDay = '星期四';
                    }
                    elseif($week == 5){
                        $weekDay = '星期五';
                    }
                    elseif($week == 6){
                        $weekDay = '星期六';
                    }

                    if($date >= explode(' ',$value->startTime)[0]){ //今日日期是否大於等於設定日期

                        $weekArray = explode(',',$value->weekend);  //取得設定的星期數

                        foreach ($weekArray as $k => $v) {
                            if($v == $weekDay){ //判斷是否符合今日星期
                                $timeKey = $k;
                                $push = 'Y';
                            }
                        }

                        if(isset($push) && $push == 'Y'){   //要推
                            $weekPushTime = explode(',',$value->weekendTime)[$timeKey].":00";   //取得推播時間

                            if($time == $weekPushTime){
                                
                                $meet = explode(',',$value->meeting);   //取得所有通知人名
                                $meetArray = array();
                                foreach ($meet as $k => $v) {
                                    array_push($meetArray, explode(' ',$v)[1]);
                                }

                                $meetImp = implode('、', $meetArray);    //人名、隔開

                                $other = $value->other;
                                if($other == null){
                                    $other = '無';
                                }

                                $tokenArray = explode(',',$value->token);

                                $client = new \GuzzleHttp\Client();
                                $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                                   'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                   'body' => json_encode([
                                    'to' => $tokenArray,
                                    'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                                ])
                               ]);
                            }
                        }
                    }
                }
                else{

                    $push = 'N';
                    $nowWeek = Carbon::now()->weekOfYear; //取得目前是第幾週
                    $weekYear = Carbon::createFromFormat('Y-m-d', explode(' ',$value->startTime)[0])->weekOfYear; //取得設定起始日是第幾週

                    if($date >= explode(' ',$value->startTime)[0]){ //今日日期是否大於等於設定日期

                        if( ($nowWeek-$weekYear)%$value->week == 0){    //結果=0 代表本週要推播

                            $week = Carbon::now()->dayOfWeek;   //取得當天星期幾

                            if($week == 0){
                                $weekDay = '星期日';
                            }
                            elseif($week == 1){
                                $weekDay = '星期一';
                            }
                            elseif($week == 2){
                                $weekDay = '星期二';
                            }
                            elseif($week == 3){
                                $weekDay = '星期三';
                            }
                            elseif($week == 4){
                                $weekDay = '星期四';
                            }
                            elseif($week == 5){
                                $weekDay = '星期五';
                            }
                            elseif($week == 6){
                                $weekDay = '星期六';
                            }

                            $weekArray = explode(',',$value->weekend);  //取得設定的星期數

                            foreach ($weekArray as $k => $v) {
                                if($v == $weekDay){     //判斷是否符合今日星期
                                    $timeKey = $k;
                                    $push = 'Y';
                                }
                            }
                            if(isset($push) && $push == 'Y'){   //要推
                                
                                $weekPushTime = explode(',',$value->weekendTime)[$timeKey].":00";   //取得推播時間

                                if($time == $weekPushTime){
                                    
                                    $meet = explode(',',$value->meeting);   //取得所有通知人名
                                    $meetArray = array();
                                    foreach ($meet as $k => $v) {
                                        array_push($meetArray, explode(' ',$v)[1]);
                                    }

                                    $meetImp = implode('、', $meetArray);    //人名、隔開

                                    $other = $request->other;
                                    if($other == null){
                                        $other = '無';
                                    }

                                    $tokenArray = explode(',',$value->token);

                                    $client = new \GuzzleHttp\Client();
                                    $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                                       'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                                       'body' => json_encode([
                                        'to' => $tokenArray,
                                        'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                                    ])
                                   ]);
                                }
                            }
                        }
                    }
                }
            }
            elseif($value->category == '每月'){

                if($date >= explode(' ',$value->startTime)[0]){ //今日日期是否大於等於設定日期

                    if($day == explode('-',explode(' ',$value->startTime)[0])[2] && $time == explode(' ',$value->startTime)[1]){
                        $meet = explode(',',$value->meeting); 
                        $meetArray = array();
                        foreach ($meet as $k => $v) {
                            array_push($meetArray, explode(' ',$v)[1]); //取得所有通知人名
                        }

                        $meetImp = implode('、', $meetArray);   //人名、隔開

                        $other = $value->other;
                        if($other == null){
                            $other = '無';
                        }

                        $tokenArray = explode(',',$value->token);

                        $client = new \GuzzleHttp\Client();
                        $response = $client->post('https://api.line.me/v2/bot/message/multicast', [
                         'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer tUUaaoKE6K7OzVZGGIZ8azdFiAefwV4UwqChfM9DuCBMzdGdEbj31rt+zOuaLXGZkUnQDMqrm+wRHiKOW8WQYNwpcKe6u0Th0cRQvkgIVaM5krOGe8KGSKgGxAeAwNVph46aSdzQoJ0/O35z74Sr5FGUYhWQfeY8sLGRXgo3xvw='],
                         'body' => json_encode([
                            'to' => $tokenArray,
                            'messages' =>json_decode('[{"type":"flex","altText":"通知提醒","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"通知提醒","weight":"bold","color":"#1D77B4","size":"lg"},{"type":"box","layout":"vertical","contents":[{"type":"text","text":"'.$value->type.'","color":"#ffffff","align":"center","margin":"xs","offsetTop":"2px"}],"width":"50px","height":"20px","backgroundColor":"#1D77B4","cornerRadius":"8px","offsetTop":"20px","offsetStart":"110px","position":"absolute"},{"type":"separator","margin":"xxl"},{"type":"box","layout":"vertical","margin":"xxl","spacing":"sm","contents":[{"type":"box","layout":"baseline","contents":[{"type":"text","text":"標題","size":"md","color":"#555555","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->title.'","size":"md","color":"#111111","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"內容","flex":1,"weight":"bold"},{"type":"text","text":"'.$value->content.'","wrap":true,"flex":5}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"對象","flex":1,"weight":"bold","size":"md"},{"type":"text","text":"'.$meetImp.'","flex":5,"wrap":true}]},{"type":"filler"},{"type":"box","layout":"baseline","contents":[{"type":"text","text":"備註","weight":"bold"},{"type":"text","text":"'.$other.'","flex":5}]}]},{"type":"separator","margin":"xxl"},{"type":"box","layout":"horizontal","margin":"md","contents":[{"type":"text","text":"檢視詳細資訊","color":"#aaaaaa","size":"xs","align":"center","action":{"type":"uri","label":"action","uri":"https://liff.line.me/1654117129-k3GW53AO/HT/noticePage?id='.$value->id.'"}}]}]},"styles":{"footer":{"separator":true}}}}]')
                        ])
                     ]);
                    }
                }
            }
        }
    }
}