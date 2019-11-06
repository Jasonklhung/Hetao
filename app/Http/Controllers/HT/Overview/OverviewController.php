<?php

namespace App\Http\Controllers\HT\Overview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//model
use App\Activity;
use App\Organization;
use App\User;
//Guzzle
use GuzzleHttp\Client;
use Auth;

class OverviewController extends Controller
{
    public function index(Organization $organization)
    {
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
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

    	return view('ht.Overview.index',compact('organization','caseCount'));
    }

    public function store(Organization $organization,Request $request)
    {
        //dd($request->all());

    	 $activity = new Activity;
         $activity->organization_id = $organization->id;
         $activity->user_id = Auth::user()->name;
    	 $activity->title = $request->title;
    	 ($request->startTime == null)? $activity->start = $request->start : $activity->start = $request->start.' '.$request->startTime;
    	 ($request->endTime == null)? $activity->end = $request->end : $activity->end = $request->end.' '.$request->endTime;
    	 $activity->position = $request->position;
    	 $activity->notice = $request->notice;
         $activity->noticeTime = $request->noticeTime;
    	 $activity->meeting = substr($request->meeting,0,-1);
    	 $activity->description = $request->description;
    	 $activity->save();

    	 return redirect()->route('ht.Overview.index',compact('organization'))->with('success','新增成功');
    }

    public function show(Organization $organization,Activity $activity)
    {
    	$activity = Activity::where('organization_id',Auth::user()->organization_id)->get();

    	return $activity;
    }

    public function updateDel(Organization $organization,Request $request)
    {
        if (isset($_POST["submit"])) {
            $sub = $_POST["submit"];

            if (isset($sub["update"]))
            {
                $activity = Activity::find($request->id2);
                $activity->organization_id = $organization->id;
                $activity->user_id = Auth::user()->name;
                $activity->title = $request->title2;
                (isset($request->check))? $activity->start = $request->start2 : $activity->start = $request->start2.' '.$request->startTime2;
                (isset($request->check))? $activity->end = $request->end2 : $activity->end = $request->end2.' '.$request->endTime2;
                $activity->position = $request->position2;
                $activity->notice = $request->notice2;
                $activity->noticeTime = $request->noticeTime2;

                $meeting = implode(",", $request->meeting2);
                $activity->meeting = $meeting;

                $activity->description = $request->description2;
                $activity->save();

                return redirect()->route('ht.Overview.index',compact('organization'))->with('success','修改成功');
            } 
            elseif (isset($sub["delete"])) 
            {
               $activity = Activity::find($request->id2)->delete();

               return redirect()->route('ht.Overview.index',compact('organization'))->with('success','刪除成功');
            }
        }
    }

    public function getData(Organization $organization,Request $request)
    {

    	$client = new \GuzzleHttp\Client();
    	$response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
    		'headers' => ['Content-Type' => 'application/json'],
    		'body' => json_encode([
    			'token' => $request->token,
    			'DEPT' => $request->DEPT
    		])
    	]);

    	$response = $response->getBody()->getContents();

    	return $response;
    }

    public function getCompany(Organization $organization)
    {
        $org = Organization::all();

        return $org;
    }

    public function getName(Organization $organization,Request $request)
    {
        //dd($request->all());

        if($request->job != '其他'){

            $org = Organization::where('name',$request->company)->get(); 
            $name = User::where('organization_id',$org[0]['id'])->where('job',$request->job)->get();

            return $name;
        }
        else{

            $org = Organization::where('name',$request->company)->get(); 
            $name = User::where('organization_id',$org[0]['id'])->get();

            return $name;
        }
    }
}
