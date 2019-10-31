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

    	return view('ht.Overview.index',compact('organization'));
    }

    public function store(Organization $organization,Request $request)
    {
    	 $activity = new Activity;
         $activity->organization_id = $organization->id;
         $activity->user_id = Auth::user()->id;
    	 $activity->title = $request->title;
    	 ($request->startTime == null)? $activity->start = $request->start : $activity->start = $request->start.' '.$request->startTime;
    	 ($request->endTime == null)? $activity->end = $request->end : $activity->end = $request->end.' '.$request->endTime;
    	 $activity->position = $request->position;
    	 $activity->notice = $request->notice;
    	 $activity->meeting = $request->meeting;
    	 $activity->description = $request->description;
    	 $activity->save();

    	 return redirect()->route('ht.Overview.index',compact('organization'))->with('success','新增成功');
    }

    public function show(Organization $organization,Activity $activity)
    {
    	$activity = Activity::where('organization_id',Auth::user()->organization_id)->get();

    	return $activity;
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
