<?php

namespace App\Http\Controllers\HT\Timeset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Timeset;

class TimesetController extends Controller
{
    public function index(Organization $organization)
    {
    	$timeset = Timeset::Where('organization_id',$organization->id)->get();

    	return view('ht.Timeset.index',compact('organization','timeset'));
    }

    public function store(Organization $organization,Request $request)
    {

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '線上預約完成推播時間'],
    		['days' => '+'.$request->onlineDay, 'time' => $request->onlineTime , 'status' => ($request->online == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '預約前一日通知推播時間'],
    		['days' => '-1', 'time' => $request->reservationTime , 'status' => ($request->reservation == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '滿意度調查推播時間'],
    		['days' => '+'.$request->satisfactionDay, 'time' => $request->satisfactionTime , 'status' => ($request->satisfaction == 'on')? 'Y':'N']
    	);

    	$Timeset = Timeset::updateOrCreate(
    		['organization_id' => $organization->id, 'name' => '通知主管指派項目'],
    		['days' => 'everyday', 'time' => $request->assignTime , 'status' => ($request->assign == 'on')? 'Y':'N']
    	);

    	return redirect()->route('ht.Timeset.index',compact('organization'))->with('success','設定成功');

    }
}
