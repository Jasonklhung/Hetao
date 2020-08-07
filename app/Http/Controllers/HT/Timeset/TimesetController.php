<?php

namespace App\Http\Controllers\HT\Timeset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Timeset;
use Auth;

class TimesetController extends Controller
{
    public function index(Organization $organization)
    {
    	$timeset = Timeset::Where('organization_id',$organization->id)->get();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工' || $job == '業務'){
            $countArray = SupervisorCase::where('owner_id',Auth::user()->id)->whereIn('status',[null,'','F'])->get();

            $caseCount = count($countArray);
        }else{
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//$organization->name
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

    	return view('ht.Timeset.index',compact('organization','timeset','caseCount'));
    }

    public function store(Organization $organization,Request $request)
    {

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '線上預約完成推播時間'],
    		['days' => $request->onlineDay, 'time' => $request->onlineTime , 'status' => ($request->online == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '預約前一日通知推播時間'],
    		['days' => '1', 'time' => $request->reservationTime , 'status' => ($request->reservation == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '滿意度調查推播時間'],
    		['days' => $request->satisfactionDay, 'time' => $request->satisfactionTime , 'status' => ($request->satisfaction == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '通知主管指派項目'],
    		['days' => 'everyday', 'time' => $request->assignTime , 'status' => ($request->assign == 'on')? 'Y':'N']
    	);

    	return redirect()->route('ht.Timeset.index',compact('organization'))->with('success','設定成功');

    }
}
