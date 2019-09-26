<?php

namespace App\Http\Controllers\HT\Overview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//model
use App\Activity;
//Guzzle
use GuzzleHttp\Client;

use flash;

class OverviewController extends Controller
{
    public function index()
    {
    	return view('ht.Overview.index');
    }

    public function store(Activity $activity,Request $request)
    {
    	 $activity = new Activity;
    	 $activity->title = $request->title;
    	 ($request->startTime == null)? $activity->start = $request->start : $activity->start = $request->start.' '.$request->startTime;
    	 ($request->endTime == null)? $activity->end = $request->end : $activity->end = $request->end.' '.$request->endTime;
    	 $activity->position = $request->position;
    	 $activity->notice = $request->notice;
    	 $activity->meeting = $request->meeting;
    	 $activity->description = $request->description;
    	 $activity->save();

    	 return redirect()->route('ht.Overview.index')->with('success','新增成功');
    }

    public function show(Activity $activity)
    {
    	$users = Activity::all();

    	return $users;
    }

    public function getData(Request $request)
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

    public function test(Request $request)
    {
        dd($request->all());
    }
}
