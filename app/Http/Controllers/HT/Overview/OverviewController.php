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
use App\ReservationAnswer;

class OverviewController extends Controller
{
    public function index(Organization $organization)
    {

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
        
        $user = User::where('organization_id',$organization->id)->where('job','主管')->where('token','!=','')->get();

        $company = Organization::all();

        return view('ht.Overview.index',compact('organization','caseCount','company','user'));
    }

    public function store(Organization $organization,Request $request)
    {
        //dd($request->all());

        if($request->start == null){
            $request->start = date('Y-m-d');
        }

        if($request->end == null){
            $request->end = date('Y-m-d');
        }

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
        else{
            $push = null;
        }

        $activity = new Activity;
        $activity->organization_id = $organization->id;
        $activity->user_id = Auth::user()->name;
        $activity->owner = Auth::user()->id;
        $activity->title = $request->title;
        ($request->startTime == null)? $activity->start = $request->start : $activity->start = $request->start.' '.$request->startTime;
        ($request->endTime == null)? $activity->end = $request->end : $activity->end = $request->end.' '.$request->endTime;
        $activity->position = $request->position;
        $activity->notice = $request->notice;
        $activity->noticeTime = $request->noticeTime;
        $activity->pushDate = $push;

        if($request->meeting == null || $request->meeting == '會議對象'){

            $dept = Organization::where('id',$organization->id)->get();
            $activity->meeting = $dept[0]['name']."/".Auth::user()->job.Auth::user()->name;
            $activity->meetingToken = Auth::user()->token;
        }
        else{

            if(strpos(substr($request->meetingToken,0,-1),Auth::user()->token) === false){ 

                $dept = Organization::where('id',$organization->id)->get();
                $activity->meeting = substr($request->meeting,0,-1).",".$dept[0]['name']."/".Auth::user()->job.Auth::user()->name;
                $activity->meetingToken = substr($request->meetingToken,0,-1).",".Auth::user()->token;
            }
            else{
                $activity->meeting = substr($request->meeting,0,-1);
                $activity->meetingToken = substr($request->meetingToken,0,-1);
            }
        }

        $activity->description = $request->description;
        $activity->save();

         return redirect()->route('ht.Overview.index',compact('organization'))->with('success','新增成功');
    }

    public function show(Organization $organization,Activity $activity,Request $request)
    {

        $activity = Activity::where('organization_id',$organization->id)->where('owner',Auth::user()->id)->orderBy('start','asc')->get();

        $activityAll = Activity::where('organization_id',$organization->id)->orderBy('start','asc')->get();

        $activityJoin = array();

        foreach ($activityAll as $key => $value) {

            if(strpos($value['meetingToken'],Auth::user()->token) !== false){ 
                $activityJoin[] = $value;
            }
        }

        return $activityJoin;
    }

    public function showAll(Organization $organization,Activity $activity,Request $request)
    {

        $activity = Activity::where('organization_id',$organization->id)->orderBy('start','asc')->get();

        return $activity;
    }

    public function search(Organization $organization,Request $request)
    {
        $oneDay = Activity::where('organization_id',$organization->id)->whereDate('start',$request->date)->orderBy('start','asc')->get();


        $activity = Activity::where('organization_id',$organization->id)
                    ->whereDate('start','<',$request->date)
                    ->whereDate('end','>=',$request->date)
                    ->orderBy('start','asc')
                    ->get();

        $oneDayArray = array();
        $activityArray = array();

        foreach ($oneDay as $key => $value) {

            if(strpos($value['meetingToken'],Auth::user()->token) !== false){ 
                $oneDayArray[] = $value;
            }
        }

        foreach ($activity as $key => $value) {

            if(strpos($value['meetingToken'],Auth::user()->token) !== false){ 
                $activityArray[] = $value;
            }
        }

        if($oneDayArray != '' && $activityArray == ''){
            return [$oneDayArray];
        }
        elseif($oneDayArray == '' && $activityArray != ''){
            return [$activityArray];
        }
        else{
            return [$oneDayArray,$activityArray];
        }
    }

    public function searchAll(Organization $organization,Request $request)
    {
        $oneDay = Activity::where('organization_id',$organization->id)->whereDate('start',$request->date)->orderBy('start','asc')->get();


        $activity = Activity::where('organization_id',$organization->id)
                    ->whereDate('start','<',$request->date)
                    ->whereDate('end','>=',$request->date)
                    ->orderBy('start','asc')
                    ->get();

        if($oneDay->isNotEmpty() && $activity->isEmpty()){
            return [$oneDay];
        }
        elseif($oneDay->isEmpty() && $activity->isNotEmpty()){
            return [$activity];
        }
        else{
            return [$oneDay,$activity];
        }
    }

    public function searchAct(Organization $organization,Request $request)
    {
        $activity = Activity::find($request->id);

        return $activity;
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
                else{
                    $push = null;
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

                $meetingToken = array();

                foreach ($request->meeting2 as $k => $v) {
                    $name = explode('/', $v)[1];

                    $name = mb_substr($name,2);

                    $token = User::where('name',$name)->get();

                    $token = $token[0]->token;

                    array_push($meetingToken, $token);
                }

                $finalToken = implode(',', $meetingToken);

                $activity->meetingToken = $finalToken;

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

        $dept = Organization::where('id',$request->DEPT)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $newArray = array();

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

        if(!$data){
            return [];
        }
        else{
            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;
                }
            }

            foreach ($array as $key => $value) {
                if($value->owner == Auth::user()->name){
                    $newArray[] = $value;
                }
            }

            foreach ($newArray as $k => $v) {
                if(!in_array($v->time, $date)){
                    array_push($date, $v->time);
                }
            }

            foreach ($newArray as $k => $v) {
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

            foreach ($test as $aa => $aaa) {
                if($aa == 0 || $aaa == null || $aaa == 'F'){
                    unset($test[$aa]);
                }
            }

            //$test = array_splice($test, '0'); 
           // $test = array_splice($test, '1'); 
            //$test = array_splice($test, '2'); 


            return $test;
        }
    }

    public function getAllData(Organization $organization,Request $request)
    {

        $dept = Organization::where('id',$request->DEPT)->get();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->token,
                'DEPT' => $dept[0]['name']
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $newArray = array();

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

        if(!$data){
            return [];
        }
        else{
            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;
                }
            }

            foreach ($array as $key => $value) {
                //if($value->owner == Auth::user()->name){
                    $newArray[] = $value;
                //}
            }

            foreach ($newArray as $k => $v) {
                if(!in_array($v->time, $date)){
                    array_push($date, $v->time);
                }
            }

            foreach ($newArray as $k => $v) {
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

            foreach ($test as $aa => $aaa) {
                if($aa == 0 || $aaa == null || $aaa == 'F'){
                    unset($test[$aa]);
                }
            }

            //$test = array_splice($test, '0'); 
           // $test = array_splice($test, '1'); 
            //$test = array_splice($test, '2'); 


            return $test;
        }
    }

    public function getCompany(Organization $organization)
    {
        $org = Organization::all();

        return $org;
    }

    public function getName(Organization $organization,Request $request)
    {
        //dd($request->all());

        $dept = Organization::where('name',$request->company)->get();
        $allUser = User::all();
        $deptUser = array();

        if($request->job != '其他'){

            foreach ($allUser as $key => $value) {
                if($value->organization_id == $dept[0]['id'] && $value->job == $request->job && ($value->token != '' || $value->token != null)){
                    $deptUser[] = array("name"=>$value->name,"token"=>$value->token);
                }
            }

            foreach ($allUser as $key => $value) {
                $many = explode(',', $value->organizations);

                foreach ($many as $k => $v) {
                    if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id'] && $value->job == $request->job && ($value->token != '' || $value->token != null)){
                        $deptUser[] = array("name"=>$value->name,"token"=>$value->token);
                    }
                }
            }
        }
        else{

            foreach ($allUser as $key => $value) {
                if($value->organization_id == $dept[0]['id']  && ($value->token != '' || $value->token != null)){
                    $deptUser[] = array("name"=>$value->name,"token"=>$value->token);
                }
            }

            foreach ($allUser as $key => $value) {
                $many = explode(',', $value->organizations);

                foreach ($many as $k => $v) {
                    if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id'] && ($value->token != '' || $value->token != null)){
                        $deptUser[] = array("name"=>$value->name,"token"=>$value->token);
                    }
                }
            }
        }

        return $deptUser;
    }
}
