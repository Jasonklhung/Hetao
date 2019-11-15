<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Organization;
use App\Department;
use DB;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        $richmenuId = 'richmenu-b091aa3f171ce930505b87d8bbf00873' ;
        $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.line.me/v2/bot/user/'.$request->userId.'/richmenu/'.$richmenuId, [
            'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
        ]);

        $findAccount = Account::where('token',$request->userId)->get();

        $depart = Department::where('name',$request->DEPT)->get();

        if($findAccount->isNotEmpty()){
            $account = new Account;
            $account->organization_id = $depart[0]['organization_id'];
            $account->department_id = $depart[0]['id'];
            $account->token = $request->userId;
            $account->cuskey = $request->CUSTKEY;
            $account->name = $request->name;
            $account->card_number = $request->CARDNO;
            $account->save();

            return response()->json(['success'=>['ok']]);
        }
        else{
            DB::table('accounts')
                ->where('token',$request->userId)
                ->update(['organization_id' => $depart[0]['organization_id'],
                          'department_id' => $depart[0]['id'],
                          'cuskey' => $request->CUSTKEY,
                          'name' => $request->name,
                          'card_number'=> $request->CARDNO]);

            return response()->json(['success'=>['ok']]);
        }
    }
}
