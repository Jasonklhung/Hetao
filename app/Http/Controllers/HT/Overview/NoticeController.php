<?php

namespace App\Http\Controllers\HT\Overview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\User;
use App\Notice;

class NoticeController extends Controller
{
    public function index(Organization $organization)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

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

        $org = Organization::where('id','!=','1')->get();

        //所有通知
        $dept = Organization::where('id',$organization->id)->get();
        $notice = Notice::where('organization_name',$dept[0]['name'])->where('user_id',Auth::user()->id)->orderBy('startTime','desc')->get();

        return view('ht.Overview.notice.index',compact('organization','caseCount','org','notice'));
    }

    public function getUserName(Organization $organization,Request $request)
    {

        $dept = Organization::where('name',$request->company)->get();
        $allUser = User::all();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id'] && $value->token != null && $value->job == $request->job){
                $deptUser[] = array("token"=>$value->token,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id'] && $value->token != null && $value->job == $request->job){
                    $deptUser[] = array("token"=>$value->token,"name"=>$value->name);
                }
            }
        }

        return $deptUser;
    }

    public function store(Organization $organization,Request $request)
    {

        //dd($request->all());

        $dept = Organization::where('id',$organization->id)->get();

        $notice = new Notice;
        $notice->organization_name = $dept[0]['name'];
        $notice->user_id = Auth::user()->id;
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->category = $request->category;
        if($request->category == '單次'){
            $notice->startTime = $request->startTimeOnce;
        }
        elseif($request->category == '每日'){
            $notice->startTime = $request->startTimeEveryDay;
        }
        if($request->category == '每週'){
            $notice->startTime = $request->startTimeEveryWeek;
        }
        if($request->category == '每月'){
            $notice->startTime = $request->startTimeEveryMonth;
        }

        $notice->week = $request->week;
        if($request->category == '每週'){
            $weekend = implode(',', $request->weekend);
            $weekendTime = implode(',', $request->weekendTime);

            $notice->weekend = $weekend;
            $notice->weekendTime = $weekendTime;
        }
        else{
            $notice->weekend = null;
            $notice->weekendTime = null;
        }

        //取得新增人的分公司/職稱 姓名
        if($request->meetingName == null){
            $notice->meeting = $dept[0]['name']."/".Auth::user()->job." ".Auth::user()->name;
        }
        else{
            $notice->meeting = $request->meetingName;
        }

        if($request->meetingToken == null){
            $notice->token = Auth::user()->token;
        }
        else{
           $notice->token = $request->meetingToken;
        }

        $notice->type = $request->type;
        $notice->other = $request->other;
        $notice->save();

        return redirect()->route('ht.Overview.notice.index',compact('organization'))->with('success','新增成功');
    }

    public function getNotice(Organization $organization,Request $request)
    {
        $notice = Notice::find($request->id);

        return $notice;
    }

    public function edit(Organization $organization,Request $request)
    {

        $sub = $request->submit;

        if(isset($sub["del"]))
        {
            $notice = Notice::find($request->id);
            $notice->delete();

            return redirect()->route('ht.Overview.notice.index',compact('organization'))->with('success','刪除成功');
        } 
        elseif(isset($sub["save"])) 
        {
            $notice = Notice::find($request->id);
            $notice->title = $request->title;
            $notice->content = $request->content;
            $notice->category = $request->category2;

            if($request->category2 == '單次'){
                $notice->startTime = $request->startTimeOnce;
            }
            elseif($request->category2 == '每日'){
                $notice->startTime = $request->startTimeEveryDay;
            }
            if($request->category2 == '每週'){
                $notice->startTime = $request->startTimeEveryWeek;
            }
            if($request->category2 == '每月'){
                $notice->startTime = $request->startTimeEveryMonth;
            }
            $notice->week = $request->week;

            if($request->category2 == '每週'){
                $weekend = implode(',', $request->weekend);
                $weekendTime = implode(',', $request->weekendTime);

                $notice->weekend = $weekend;
                $notice->weekendTime = $weekendTime;
            }
            else{
                $notice->weekend = null;
                $notice->weekendTime = null;
            }
            $notice->meeting = $request->meetingName2;
            $notice->token = $request->meetingToken2;
            $notice->type = $request->type;
            $notice->other = $request->other;
            $notice->save();

            return redirect()->route('ht.Overview.notice.index',compact('organization'))->with('success','儲存成功');
        }
    }

    public function noticeSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $end = date("Y-m-d",strtotime("+1 day",strtotime($end)));

        $dept = Organization::where('id',$organization->id)->get();
        $notice = Notice::where('organization_name',$dept[0]['name'])
                        ->where('user_id',Auth::user()->id)
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('startTime',[$start,$end]);
                        })
                        ->orderBy('startTime','desc')
                        ->get();

        return $notice;
    }
}
