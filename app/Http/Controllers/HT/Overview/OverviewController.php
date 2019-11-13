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
use Carbon\Carbon;

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

        //計算該推播的日期   
        if($request->noticeTime == '分鐘前'){
            if($request->startTime == null){
                $push = Carbon::parse($request->start)->subMinutes($request->notice)->format('Y-m-d H:i:s');
            }
            else{
                $push = Carbon::parse($request->start.' '.$request->startTime)->subMinutes($request->notice)->format('Y-m-d H:i:s');
            }
        }
        elseif($request->noticeTime == '小時前'){
            if($request->startTime == null){
                $push = Carbon::parse($request->start)->subHours($request->notice)->format('Y-m-d H:i:s');
            }
            else{
                $push = Carbon::parse($request->start.' '.$request->startTime)->subHours($request->notice)->format('Y-m-d H:i:s');
            }
        }
        elseif($request->noticeTime == '天前'){
            if($request->startTime == null){
                $push = Carbon::parse($request->start)->subDays($request->notice)->format('Y-m-d H:i:s');
            }
            else{
                $push = Carbon::parse($request->start.' '.$request->startTime)->subDays($request->notice)->format('Y-m-d H:i:s');
            }
        }
        elseif($request->noticeTime == '週前'){
            if($request->startTime == null){
                $push = Carbon::parse($request->start)->subWeeks($request->notice)->format('Y-m-d H:i:s');
            }
            else{
                $push = Carbon::parse($request->start.' '.$request->startTime)->subWeeks($request->notice)->format('Y-m-d H:i:s');
            }
        }

    	 $activity = new Activity;
         $activity->organization_id = Auth::user()->organization_id;
         $activity->user_id = Auth::user()->name;
         $activity->owner = Auth::user()->id;
    	 $activity->title = $request->title;
    	 ($request->startTime == null)? $activity->start = $request->start : $activity->start = $request->start.' '.$request->startTime;
    	 ($request->endTime == null)? $activity->end = $request->end : $activity->end = $request->end.' '.$request->endTime;
    	 $activity->position = $request->position;
    	 $activity->notice = $request->notice;
         $activity->noticeTime = $request->noticeTime;
         $activity->pushDate = $push;
    	 $activity->meeting = substr($request->meeting,0,-1);
    	 $activity->description = $request->description;
    	 $activity->save();

    	 return redirect()->route('ht.Overview.index',compact('organization'))->with('success','新增成功');
    }

    public function show(Organization $organization,Activity $activity,Request $request)
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

        $data = json_decode($response);

        $date = array();
        $typeArray = array();
        $custkeyArray = array();
        $addressArray = array();
        $mobileArray = array();
        $reasonArray = array();
        $ownerArray = array();
        $idArray = array();
        $dateArray = array();
        $statusArray = array();

        $typeNew = array();
        $custkeyNew = array();
        $addressNew = array();
        $mobileNew = array();
        $reasonNew = array();
        $ownerNew = array();
        $idNew = array();
        $dateNew = array();
        $statusNew = array();

        $test = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }

        foreach ($array as $k => $v) {
            if(!in_array($v->time, $date)){
                array_push($date, $v->time);
            }
        }

        foreach ($array as $k => $v) {
            foreach ($date as $kk => $vv) {
                if($v->time == $vv){
                    $typeArray[$vv][] = $v->work_type;
                    $custkeyArray[$vv][] = $v->CUSTKEY;
                    $addressArray[$vv][] = $v->address;
                    $mobileArray[$vv][] = $v->mobile;
                    $reasonArray[$vv][] = $v->remarks;
                    $ownerArray[$vv][] = $v->owner;
                    $idArray[$vv][] = $v->id;
                    $dateArray[$vv][] = $v->time;
                    $statusArray[$vv][] = $v->status;
                }
            }
        }

        foreach ($typeArray as $type => $types) {

            $test = array();

            foreach ($types as $aa => $aaa) {

                end($types);

                $last = key($types);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $typeNew[$type]['type'] = $resultArray;
                }

            }
        }

        foreach ($custkeyArray as $custkey => $custkeys) {

            $test = array();

            foreach ($custkeys as $aa => $aaa) {

                end($custkeys);

                $last = key($custkeys);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $custkeyNew[$custkey]['custkey'] = $resultArray;
                }

            }
        }

        foreach ($addressArray as $address => $addresss) {

            $test = array();

            foreach ($addresss as $aa => $aaa) {

                end($addresss);

                $last = key($addresss);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $addressNew[$address]['address'] = $resultArray;
                }

            }
        }

        foreach ($mobileArray as $mobile => $mobiles) {

            $test = array();

            foreach ($mobiles as $aa => $aaa) {

                end($mobiles);

                $last = key($mobiles);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $mobileNew[$mobile]['mobile'] = $resultArray;
                }

            }
        }

        foreach ($reasonArray as $reason => $reasons) {

            $test = array();

            foreach ($reasons as $aa => $aaa) {

                end($reasons);

                $last = key($reasons);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $reasonNew[$reason]['reason'] = $resultArray;
                }

            }
        }

        foreach ($ownerArray as $owner => $owners) {

            $test = array();

            foreach ($owners as $aa => $aaa) {

                end($owners);

                $last = key($owners);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $ownerNew[$owner]['owner'] = $resultArray;
                }

            }
        }

        foreach ($idArray as $id => $ids) {

            $test = array();

            foreach ($ids as $aa => $aaa) {

                end($ids);

                $last = key($ids);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $idNew[$id]['number'] = $resultArray;
                }

            }
        }

        foreach ($dateArray as $date => $dates) {

            $test = array();

            foreach ($dates as $aa => $aaa) {

                $dateNew[$date]['date'] = $date;

            }
        }

        foreach ($statusArray as $status => $statuss) {

            $test = array();

            foreach ($statuss as $aa => $aaa) {

                end($statuss);

                $last = key($statuss);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $statusNew[$status]['status'] = $resultArray;
                }

            }
        }

        foreach ($typeNew as $key => $value) {
            foreach ($custkeyNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $value;
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($addressNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($mobileNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($reasonNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($ownerNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($idNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($dateNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($statusNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        $test = array_splice($test, '0'); 
        $test = array_splice($test, '1'); 
        $test = array_splice($test, '2'); 

        $activity = Activity::where('organization_id',Auth::user()->organization_id)->get();

        $date = array();
        $MeetIdArray = array();
        $titleArray = array();
        $startArray = array();
        $endArray = array();
        $positionArray = array();
        $meetingArray = array();
        $noticeArray = array();
        $noticeTimeArray = array();
        $descriptionArray = array();
        $MeetOwnerArray = array();
        $MeetDateArray = array();

        $MeetIdNew = array();
        $titleNew = array();
        $startNew = array();
        $endNew = array();
        $positionNew = array();
        $meetingNew = array();
        $noticeNew = array();
        $noticeTimeNew = array();
        $descriptionNew = array();
        $MeetOwnerNew = array();
        $MeetDateNew = array();

        $sameDate = array();

        $result = array();


        foreach ($array as $k => $v) {
            if(!in_array($v->time, $date)){
                array_push($date, $v->time);
            }
        }

        foreach ($activity as $key => $value) {
            
           if(in_array(explode(' ', $value->start)[0],$date) ){
                array_push($sameDate,explode(' ', $value->start)[0]);
           }
        }

        foreach ($activity as $key => $value) {
            
           if(!in_array(explode(' ', $value->start)[0],$date) ){
                array_push($date,explode(' ', $value->start)[0]);
           }
        }


        foreach ($activity as $key => $value) {
            foreach ($date as $k => $v) {
                if(explode(' ', $value->start)[0] == $v){
                    $MeetIdArray[$v][] = $value->id;
                    $titleArray[$v][] = $value->title;
                    $startArray[$v][] = $value->start;
                    $endArray[$v][] = $value->end;
                    $positionArray[$v][] = $value->position;
                    $meetingArray[$v][] = $value->meeting;
                    $noticeArray[$v][] = $value->notice;
                    $noticeTimeArray[$v][] = $value->noticeTime;
                    $descriptionArray[$v][] = $value->description;
                    $MeetOwnerArray[$v][] = $value->user_id;
                    $MeetDateArray[$v][] = explode(" ",$value->start)[0];
                }
            }
        }

        foreach ($MeetIdArray as $id => $ids) {

            $test2 = array();

            foreach ($ids as $aa => $aaa) {

                end($ids);

                $last = key($ids);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $MeetIdNew[$id]['id'] = $resultArray;
                }

            }
        }

        foreach ($titleArray as $title => $titles) {

            $test2 = array();

            foreach ($titles as $aa => $aaa) {

                end($titles);

                $last = key($titles);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $titleNew[$title]['title'] = $resultArray;
                }

            }
        }

        foreach ($startArray as $start => $starts) {

            $test2 = array();

            foreach ($starts as $aa => $aaa) {

                end($starts);

                $last = key($starts);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $startNew[$start]['start'] = $resultArray;
                }

            }
        }

        foreach ($endArray as $end => $ends) {

            $test2 = array();

            foreach ($ends as $aa => $aaa) {

                end($ends);

                $last = key($ends);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $endNew[$end]['end'] = $resultArray;
                }

            }
        }

        foreach ($positionArray as $position => $positions) {

            $test2 = array();

            foreach ($positions as $aa => $aaa) {

                end($positions);

                $last = key($positions);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $positionNew[$position]['position'] = $resultArray;
                }

            }
        }

        foreach ($meetingArray as $meeting => $meetings) {

            $test2 = array();

            foreach ($meetings as $aa => $aaa) {

                end($meetings);

                $last = key($meetings);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $meetingNew[$meeting]['meeting'] = $resultArray;
                }

            }
        }

        foreach ($noticeArray as $notice => $notices) {

            $test2 = array();

            foreach ($notices as $aa => $aaa) {

                end($notices);

                $last = key($notices);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $noticeNew[$notice]['notice'] = $resultArray;
                }

            }
        }

        foreach ($noticeTimeArray as $noticeTime => $noticeTimes) {

            $test2 = array();

            foreach ($noticeTimes as $aa => $aaa) {

                end($noticeTimes);

                $last = key($noticeTimes);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $noticeTimeNew[$noticeTime]['noticeTime'] = $resultArray;
                }

            }
        }

        foreach ($descriptionArray as $description => $descriptions) {

            $test2 = array();

            foreach ($descriptions as $aa => $aaa) {

                end($descriptions);

                $last = key($descriptions);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $descriptionNew[$description]['description'] = $resultArray;
                }

            }
        }

        foreach ($MeetOwnerArray as $owner => $owners) {

            $test2 = array();

            foreach ($owners as $aa => $aaa) {

                end($owners);

                $last = key($owners);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $MeetOwnerNew[$owner]['MeetOwner'] = $resultArray;
                }

            }
        }

        foreach ($MeetDateArray as $date => $dates) {

            $test2 = array();

            foreach ($dates as $aa => $aaa) {

                $MeetDateNew[$date]['MeetDate'] = $aaa;

            }
        }


        foreach ($MeetIdNew as $key => $value) {
            foreach ($titleNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $value;
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($startNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($endNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($positionNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($meetingNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($noticeNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($noticeTimeNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($descriptionNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($MeetOwnerNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($MeetDateNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        $test = array_values($test);
        $result = array_values($result);

        $abc = array();

        $final = array_merge($test,$result);

        foreach ($final as $key => $value) {
            foreach ($sameDate as $k => $v) {
                if(isset($value[10])){
                    if($value[10]['MeetDate'] == $v){
                        $abc[$v][] = $value;
                    }
                }
                else{
                    if($value[7]['date'] == $v){
                        $abc[$v][] = $value;
                    }
                }
            }
        }

        return [$final,$abc,$sameDate];
    }

    public function updateDel(Organization $organization,Request $request)
    {

        if (isset($_POST["submit"])) {
            $sub = $_POST["submit"];

            if (isset($sub["update"]))
            {
                //計算該推播的日期   
                if($request->noticeTime2 == '分鐘前'){
                    if(isset($request->check)){
                        $push = Carbon::parse($request->start2)->subMinutes($request->notice2)->format('Y-m-d H:i:s');
                    }
                    else{
                        $push = Carbon::parse($request->start2.' '.$request->startTime2)->subMinutes($request->notice2)->format('Y-m-d H:i:s');
                    }
                }
                elseif($request->noticeTime2 == '小時前'){
                    if(isset($request->check)){
                        $push = Carbon::parse($request->start2)->subHours($request->notice2)->format('Y-m-d H:i:s');
                    }
                    else{
                        $push = Carbon::parse($request->start2.' '.$request->startTime2)->subHours($request->notice2)->format('Y-m-d H:i:s');
                    }
                }
                elseif($request->noticeTime2 == '天前'){
                    if(isset($request->check)){
                        $push = Carbon::parse($request->start2)->subDays($request->notice2)->format('Y-m-d H:i:s');
                    }
                    else{
                        $push = Carbon::parse($request->start2.' '.$request->startTime2)->subDays($request->notice2)->format('Y-m-d H:i:s');
                    }
                }
                elseif($request->noticeTime2 == '週前'){
                    if(isset($request->check)){
                        $push = Carbon::parse($request->start2)->subWeeks($request->notice2)->format('Y-m-d H:i:s');
                    }
                    else{
                        $push = Carbon::parse($request->start2.' '.$request->startTime2)->subWeeks($request->notice2)->format('Y-m-d H:i:s');
                    }
                }

                $activity = Activity::find($request->id2);
                $activity->organization_id = $organization->id;
                $activity->user_id = Auth::user()->name;
                $activity->title = $request->title2;
                (isset($request->check))? $activity->start = $request->start2 : $activity->start = $request->start2.' '.$request->startTime2;
                (isset($request->check))? $activity->end = $request->end2 : $activity->end = $request->end2.' '.$request->endTime2;
                $activity->position = $request->position2;
                $activity->notice = $request->notice2;
                $activity->noticeTime = $request->noticeTime2;
                $activity->pushDate = $push;

                $meeting = implode(",", $request->meeting2);
                $activity->meeting = $meeting;

                $activity->description = $request->description2;
                $activity->save();

                return redirect()->route('ht.Overview.index',compact('organization'))->with('success','修改成功');
            } 
            elseif (isset($sub["delete"])) 
            {
               if(Activity::find($request->id2)->owner == Auth::user()->id){

                    $activity = Activity::find($request->id2)->delete();

                    return redirect()->route('ht.Overview.index',compact('organization'))->with('success','刪除成功');
               }
               else{

                    return redirect()->route('ht.Overview.index',compact('organization'))->with('error','無此活動刪除權限');
               }
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

        $data = json_decode($response);

        $date = array();
        $typeArray = array();
        $custkeyArray = array();
        $addressArray = array();
        $mobileArray = array();
        $reasonArray = array();
        $ownerArray = array();
        $idArray = array();
        $dateArray = array();
        $statusArray = array();

        $typeNew = array();
        $custkeyNew = array();
        $addressNew = array();
        $mobileNew = array();
        $reasonNew = array();
        $ownerNew = array();
        $idNew = array();
        $dateNew = array();
        $statusNew = array();

        $test = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;
            }
        }

        foreach ($array as $k => $v) {
            if(!in_array($v->time, $date)){
                array_push($date, $v->time);
            }
        }

        foreach ($array as $k => $v) {
            foreach ($date as $kk => $vv) {
                if($v->time == $vv){
                    $typeArray[$vv][] = $v->work_type;
                    $custkeyArray[$vv][] = $v->CUSTKEY;
                    $addressArray[$vv][] = $v->address;
                    $mobileArray[$vv][] = $v->mobile;
                    $reasonArray[$vv][] = $v->remarks;
                    $ownerArray[$vv][] = $v->owner;
                    $idArray[$vv][] = $v->id;
                    $dateArray[$vv][] = $v->time;
                    $statusArray[$vv][] = $v->status;
                }
            }
        }

        foreach ($typeArray as $type => $types) {

            $test = array();

            foreach ($types as $aa => $aaa) {

                end($types);

                $last = key($types);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $typeNew[$type]['type'] = $resultArray;
                }

            }
        }

        foreach ($custkeyArray as $custkey => $custkeys) {

            $test = array();

            foreach ($custkeys as $aa => $aaa) {

                end($custkeys);

                $last = key($custkeys);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $custkeyNew[$custkey]['custkey'] = $resultArray;
                }

            }
        }

        foreach ($addressArray as $address => $addresss) {

            $test = array();

            foreach ($addresss as $aa => $aaa) {

                end($addresss);

                $last = key($addresss);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $addressNew[$address]['address'] = $resultArray;
                }

            }
        }

        foreach ($mobileArray as $mobile => $mobiles) {

            $test = array();

            foreach ($mobiles as $aa => $aaa) {

                end($mobiles);

                $last = key($mobiles);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $mobileNew[$mobile]['mobile'] = $resultArray;
                }

            }
        }

        foreach ($reasonArray as $reason => $reasons) {

            $test = array();

            foreach ($reasons as $aa => $aaa) {

                end($reasons);

                $last = key($reasons);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $reasonNew[$reason]['reason'] = $resultArray;
                }

            }
        }

        foreach ($ownerArray as $owner => $owners) {

            $test = array();

            foreach ($owners as $aa => $aaa) {

                end($owners);

                $last = key($owners);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $ownerNew[$owner]['owner'] = $resultArray;
                }

            }
        }

        foreach ($idArray as $id => $ids) {

            $test = array();

            foreach ($ids as $aa => $aaa) {

                end($ids);

                $last = key($ids);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $idNew[$id]['number'] = $resultArray;
                }

            }
        }

        foreach ($dateArray as $date => $dates) {

            $test = array();

            foreach ($dates as $aa => $aaa) {

                $dateNew[$date]['date'] = $date;

            }
        }

        foreach ($statusArray as $status => $statuss) {

            $test = array();

            foreach ($statuss as $aa => $aaa) {

                end($statuss);

                $last = key($statuss);

                array_push($test,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test);

                    $statusNew[$status]['status'] = $resultArray;
                }

            }
        }

        foreach ($typeNew as $key => $value) {
            foreach ($custkeyNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $value;
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($addressNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($mobileNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($reasonNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($ownerNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($idNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($dateNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        foreach ($test as $key => $value) {
            foreach ($statusNew as $k => $v) {
                if($key == $k){
                    $test[$key][] = $v;
                }
            }
        }

        $test = array_splice($test, '0'); 
        $test = array_splice($test, '1'); 
        $test = array_splice($test, '2'); 

        $activity = Activity::where('organization_id',Auth::user()->organization_id)->get();

        $date = array();
        $MeetIdArray = array();
        $titleArray = array();
        $startArray = array();
        $endArray = array();
        $positionArray = array();
        $meetingArray = array();
        $noticeArray = array();
        $noticeTimeArray = array();
        $descriptionArray = array();
        $MeetOwnerArray = array();
        $MeetDateArray = array();

        $MeetIdNew = array();
        $titleNew = array();
        $startNew = array();
        $endNew = array();
        $positionNew = array();
        $meetingNew = array();
        $noticeNew = array();
        $noticeTimeNew = array();
        $descriptionNew = array();
        $MeetOwnerNew = array();
        $MeetDateNew = array();

        $sameDate = array();

        $result = array();


        foreach ($array as $k => $v) {
            if(!in_array($v->time, $date)){
                array_push($date, $v->time);
            }
        }

        foreach ($activity as $key => $value) {
            
           if(in_array(explode(' ', $value->start)[0],$date) ){
                array_push($sameDate,explode(' ', $value->start)[0]);
           }
        }

        foreach ($activity as $key => $value) {
            
           if(!in_array(explode(' ', $value->start)[0],$date) ){
                array_push($date,explode(' ', $value->start)[0]);
           }
        }


        foreach ($activity as $key => $value) {
            foreach ($date as $k => $v) {
                if(explode(' ', $value->start)[0] == $v){
                    $MeetIdArray[$v][] = $value->id;
                    $titleArray[$v][] = $value->title;
                    $startArray[$v][] = $value->start;
                    $endArray[$v][] = $value->end;
                    $positionArray[$v][] = $value->position;
                    $meetingArray[$v][] = $value->meeting;
                    $noticeArray[$v][] = $value->notice;
                    $noticeTimeArray[$v][] = $value->noticeTime;
                    $descriptionArray[$v][] = $value->description;
                    $MeetOwnerArray[$v][] = $value->user_id;
                    $MeetDateArray[$v][] = explode(" ",$value->start)[0];
                }
            }
        }

        foreach ($MeetIdArray as $id => $ids) {

            $test2 = array();

            foreach ($ids as $aa => $aaa) {

                end($ids);

                $last = key($ids);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $MeetIdNew[$id]['id'] = $resultArray;
                }

            }
        }

        foreach ($titleArray as $title => $titles) {

            $test2 = array();

            foreach ($titles as $aa => $aaa) {

                end($titles);

                $last = key($titles);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $titleNew[$title]['title'] = $resultArray;
                }

            }
        }

        foreach ($startArray as $start => $starts) {

            $test2 = array();

            foreach ($starts as $aa => $aaa) {

                end($starts);

                $last = key($starts);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $startNew[$start]['start'] = $resultArray;
                }

            }
        }

        foreach ($endArray as $end => $ends) {

            $test2 = array();

            foreach ($ends as $aa => $aaa) {

                end($ends);

                $last = key($ends);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $endNew[$end]['end'] = $resultArray;
                }

            }
        }

        foreach ($positionArray as $position => $positions) {

            $test2 = array();

            foreach ($positions as $aa => $aaa) {

                end($positions);

                $last = key($positions);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $positionNew[$position]['position'] = $resultArray;
                }

            }
        }

        foreach ($meetingArray as $meeting => $meetings) {

            $test2 = array();

            foreach ($meetings as $aa => $aaa) {

                end($meetings);

                $last = key($meetings);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $meetingNew[$meeting]['meeting'] = $resultArray;
                }

            }
        }

        foreach ($noticeArray as $notice => $notices) {

            $test2 = array();

            foreach ($notices as $aa => $aaa) {

                end($notices);

                $last = key($notices);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $noticeNew[$notice]['notice'] = $resultArray;
                }

            }
        }

        foreach ($noticeTimeArray as $noticeTime => $noticeTimes) {

            $test2 = array();

            foreach ($noticeTimes as $aa => $aaa) {

                end($noticeTimes);

                $last = key($noticeTimes);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $noticeTimeNew[$noticeTime]['noticeTime'] = $resultArray;
                }

            }
        }

        foreach ($descriptionArray as $description => $descriptions) {

            $test2 = array();

            foreach ($descriptions as $aa => $aaa) {

                end($descriptions);

                $last = key($descriptions);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $descriptionNew[$description]['description'] = $resultArray;
                }

            }
        }

        foreach ($MeetOwnerArray as $owner => $owners) {

            $test2 = array();

            foreach ($owners as $aa => $aaa) {

                end($owners);

                $last = key($owners);

                array_push($test2,$aaa);

                if($aa == $last){

                    $resultArray = implode("|||",$test2);

                    $MeetOwnerNew[$owner]['MeetOwner'] = $resultArray;
                }

            }
        }

        foreach ($MeetDateArray as $date => $dates) {

            $test2 = array();

            foreach ($dates as $aa => $aaa) {

                $MeetDateNew[$date]['MeetDate'] = $aaa;

            }
        }


        foreach ($MeetIdNew as $key => $value) {
            foreach ($titleNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $value;
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($startNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($endNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($positionNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($meetingNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($noticeNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($noticeTimeNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($descriptionNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($MeetOwnerNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($MeetDateNew as $k => $v) {
                if($key == $k){
                    $result[$key][] = $v;
                }
            }
        }

        $test = array_values($test);
        $result = array_values($result);

        $abc = array();

        $final = array_merge($test,$result);

        foreach ($final as $key => $value) {
            foreach ($sameDate as $k => $v) {
                if(isset($value[10])){
                    if($value[10]['MeetDate'] == $v){
                        $abc[$v][] = $value;
                    }
                }
                else{
                    if($value[7]['date'] == $v){
                        $abc[$v][] = $value;
                    }
                }
            }
        }

        return [$final,$abc,$sameDate];
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
