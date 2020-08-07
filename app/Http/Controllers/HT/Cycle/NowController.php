<?php

namespace App\Http\Controllers\HT\Cycle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\User;
use App\CycleAssign;

class NowController extends Controller
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

        //本月全部日期
        $j = date("t");
        $start_time = strtotime(date('Y-m-01'));
        $array = array();
        for($i=0;$i<$j;$i++){
           $array[] = date('Y-m-d',$start_time+$i*86400);
       }

       $monthDay = array();
       $allmonthDay = array();
       foreach ($array as $key => $value) {

            $time = strtotime($value);
            $week = date("l",$time);
            if($week == 'Monday'){
                $weekDay = '一';
            }
            elseif($week == 'Tuesday'){
                $weekDay = '二';
            }
            elseif($week == 'Wednesday'){
                $weekDay = '三';
            }
            elseif($week == 'Thursday'){
                $weekDay = '四';
            }
            elseif($week == 'Friday'){
                $weekDay = '五';
            }
            elseif($week == 'Saturday'){
                $weekDay = '六';
            }
            elseif($week == 'Sunday'){
                $weekDay = '日';
            }

           $monthDay[] = array("date"=>explode('-',$value)[2],'week'=>$weekDay);
           $allmonthDay[] = array("date"=>$value,'week'=>$weekDay);
       }

       $dept = Organization::where('id',$organization->id)->get();

        //全部分公司使用者
        $allUser = User::whereIn('job',['助理','主管','員工','業務'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        //進度總攬
        $staffNow = CycleAssign::where('organization_name',$dept[0]['name'])->where('statusERP','N')->get();
        $allStaffArray = array();

        foreach ($deptUser as $key => $value) {
            foreach ($allmonthDay as $k => $v) {

                $kindStillArray = array();
                $kindFinishArray = array();
                $kindFinishNotStillArray = array();
                $allcardArray = array();

                $a = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->whereDate('created_at',$v['date'])->whereNotIn('status',['F','T'])->where('statusERP','N')->get();

                $b = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->whereDate('created_at',$v['date'])->whereNotIn('status',['S','T'])->where('statusERP','N')->get();

                $c = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->whereMonth('created_at',date('m'))->where('statusERP','N')->get();

                foreach ($c as $keyy => $valuee) {
                   if(!in_array(explode('-', $valuee->kind)[0], $allcardArray)){
                        array_push($allcardArray, explode('-', $valuee->kind)[0]);
                    } 
                }

                foreach ($a as $kk => $vv) {
                    if(!in_array(explode('-', $vv->kind)[0], $kindStillArray)){
                        array_push($kindStillArray, explode('-', $vv->kind)[0]);
                    }
                }

                foreach ($b as $kks => $vvs) {
                    if(!in_array(explode('-', $vvs->kind)[0], $kindFinishArray)){
                        array_push($kindFinishArray, explode('-', $vvs->kind)[0]);
                    }
                }

                $kindStillImp = implode(',', $kindStillArray);

                if($kindStillImp){
                    foreach ($kindFinishArray as $kkk => $vvv) {
                        if(!strstr($kindStillImp,$vvv)){
                            if(!in_array($vvv, $kindFinishNotStillArray)){
                                array_push($kindFinishNotStillArray, $vvv);
                            }
                        }
                    }
                }
                else{
                    $kindFinishNotStillArray = $kindFinishArray;
                }

                $allStaffArray[$value['name']][$v['date']]['still'] = count($kindStillArray);
                $allStaffArray[$value['name']][$v['date']]['finish'] = count($kindFinishNotStillArray);
                $allStaffArray[$value['name']][$v['date']]['count'] = count($allcardArray);
            }
        }

        //進度查看
        $allStaffArray2 = array();

        foreach ($deptUser as $key => $value) {

                $kindStillArray = array();
                $kindFinishArray = array();
                $kindFinishNotStillArray = array();
                $allcardArray = array();
                $turnCardArray = array();

                $a = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->whereNotIn('status',['F','T'])->where('statusERP','N')->get();

                $b = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->whereNotIn('status',['S','T'])->where('statusERP','N')->get();

                $c = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->where('statusERP','N')->get();

                $d = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$value['name'])->where('status','T')->where('statusERP','N')->get();

                foreach ($c as $keyy => $valuee) {
                   if(!in_array(explode('-', $valuee->kind)[0], $allcardArray)){
                        array_push($allcardArray, explode('-', $valuee->kind)[0]);
                    } 
                }

                foreach ($a as $kk => $vv) {
                    if(!in_array(explode('-', $vv->kind)[0], $kindStillArray)){
                        array_push($kindStillArray, explode('-', $vv->kind)[0]);
                    }
                }

                foreach ($b as $kks => $vvs) {
                    if(!in_array(explode('-', $vvs->kind)[0], $kindFinishArray)){
                        array_push($kindFinishArray, explode('-', $vvs->kind)[0]);
                    }
                }

                foreach ($d as $kkss => $vvss) {
                    if(!in_array(explode('-', $vvss->kind)[0], $turnCardArray)){
                        array_push($turnCardArray, explode('-', $vvss->kind)[0]);
                    }
                }

                // $kindStillImp = implode(',', $kindStillArray);

                // if($kindStillImp){
                //     foreach ($kindFinishArray as $kkk => $vvv) {
                //         if(!strstr($kindStillImp,$vvv)){
                //             if(!in_array($vvv, $kindFinishNotStillArray)){
                //                 array_push($kindFinishNotStillArray, $vvv);
                //             }
                //         }
                //     }
                // }
                // else{
                //     $kindFinishNotStillArray = $kindFinishArray;
                // }

                $allStaffArray2[$value['name']]['still'] = count($kindStillArray);
                $allStaffArray2[$value['name']]['finish'] = count($kindFinishArray);
                $allStaffArray2[$value['name']]['turn'] = count($turnCardArray);
                $allStaffArray2[$value['name']]['count'] = count($allcardArray);

        }


       //分公司代號+名稱
       $companyName = $dept[0]['name']." ".$dept[0]['company_name'];

       //全站卡片數據狀態-執行中&已完成
       $allFinishCase = CycleAssign::where('organization_name',$dept[0]['name'])->where('status','F')->where('statusERP','N')->get();
       $allStillCase = CycleAssign::where('organization_name',$dept[0]['name'])->where('status','S')->where('statusERP','N')->get();

       $allFinishCaseArray = array();
       $allStillCaseArray = array();
       $allFinishNotStillArray = array();
       $allCardStatusArray = array();

       foreach ($allFinishCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allFinishCaseArray)){
                array_push($allFinishCaseArray, explode('-',$value->kind)[0]);
            }
       }

       foreach ($allStillCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allStillCaseArray)){
                array_push($allStillCaseArray, explode('-',$value->kind)[0]);
            }
       }

       // $allStillCaseImp = implode(',', $allStillCaseArray);

       // if($allStillCaseImp){
       //      foreach ($allFinishCaseArray as $kkk => $vvv) {
       //          if(!strstr($allStillCaseImp,$vvv)){
       //              if(!in_array($vvv, $allFinishNotStillArray)){
       //                  array_push($allFinishNotStillArray, $vvv);
       //              }
       //          }
       //      }
       //  }
       //  else{
       //      $allFinishNotStillArray = $allFinishCaseArray;
       //  }

        //週期儀錶板
        $fff = array();

        
        foreach ($deptUser as $keyss => $valuess) {

            $f = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$valuess['name'])->where('status','F')->where('statusERP','N')->get();

            $fff[$valuess['name']]['finish'] = 0;
            $done = array();

            foreach ($f as $keysss => $valuesss) {
                foreach ($allFinishCaseArray as $keys => $values) {

                    if(explode('-',$valuesss->kind)[0] == $values && $valuesss->staff == $valuess['name']){
                        if(!in_array(explode('-',$valuesss->kind)[0], $done)){
                            array_push($done, explode('-',$valuesss->kind)[0]);
                            $fff[$valuess['name']]['finish'] += 1;
                        }
                    }
                }
            }
        }

        $bbb = array();



        foreach ($fff as $key => $value) {

            if(count($allFinishCaseArray) == 0){
                $bbb[$key]['result'] = 0;
            }
            else{
                $bbb[$key]['result'] = round(($value['finish']/count($allFinishCaseArray))*100,2);
            }
        }

       $allCardStatusArray = [array("category"=>"已完成","column-1"=>count($allFinishCaseArray)),array("category"=>"執行中","column-1"=>count($allStillCaseArray))];

        //全站卡片數據狀態-轉單
        $allTurnCase = CycleAssign::where('organization_name',$dept[0]['name'])->where('status','T')->where('statusERP','N')->get();
        $allTurnCaseArray = array();
        $allCardTurnArray = array();
        $allNotTurnCardArray = array();

        foreach ($allTurnCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allTurnCaseArray)){
                array_push($allTurnCaseArray, explode('-',$value->kind)[0]);
            }
        }

        $ttt = array();

        
            foreach ($deptUser as $keyss => $valuess) {

                $t = CycleAssign::where('organization_name',$dept[0]['name'])->where('staff',$valuess['name'])->where('status','T')->where('statusERP','N')->get();

                $ttt[$valuess['name']]['turn'] = 0;
                $done = array();

                foreach ($t as $keysss => $valuesss) {

                    foreach ($allTurnCaseArray as $keys => $values) {

                    if(explode('-',$valuesss->kind)[0] == $values && $valuesss->staff == $valuess['name']){
                        if(!in_array(explode('-',$valuesss->kind)[0], $done)){
                                array_push($done, explode('-',$valuesss->kind)[0]);
                                $ttt[$valuess['name']]['turn'] += 1;
                            }
                        }
                    }
                }
            }

        $ccc = array();

        foreach ($ttt as $key => $value) {

            if(count($allTurnCaseArray) == 0){
                $ccc[$key]['result'] = 0;
            }
            else{
                $ccc[$key]['result'] = round(($value['turn']/count($allTurnCaseArray))*100,2);
            }
        }

        $allNotTurnCard = CycleAssign::where('organization_name',$dept[0]['name'])->where('status','!=','T')->where('statusERP','N')->get();
        foreach ($allNotTurnCard as $key => $value) {
            if(!in_array(explode('-',$value->kind)[0], $allNotTurnCardArray)){
                array_push($allNotTurnCardArray, explode('-',$value->kind)[0]);
            }
        }

        $allCardTurnArray = [array("category"=>"轉單","column-1"=>count($allTurnCaseArray)),array("category"=>"正常接單","column-1"=>count($allNotTurnCardArray))];

        return view('ht.Cycle.now.index',compact('organization','caseCount','monthDay','allStaffArray2','companyName','allStaffArray','allFinishCaseArray','bbb','allCardStatusArray','allTurnCaseArray','allCardTurnArray','ccc'));
    }

    public function staffNowSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        //進度查看
        $dept = Organization::where('id',$organization->id)->get();

       //全部分公司使用者
        $allUser = User::whereIn('job',['助理','主管','員工','業務'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        $staffNowArray = array();

        foreach ($deptUser as $key => $value) {

                $kindStillArray = array();
                $kindFinishArray = array();
                $kindFinishNotStillArray = array();
                $allcardArray = array();
                $turnCardArray = array();

                $a = CycleAssign::where('organization_name',$dept[0]['name'])
                    ->where('staff',$value['name'])
                    ->whereNotIn('status',['F','T'])
                    ->where('statusERP','N')
                    ->when($start, function ($query) use ($start,$end) {
                        return $query->whereBetween('thisDate',[$start,$end]);
                    })
                    ->get();

                $b = CycleAssign::where('organization_name',$dept[0]['name'])
                    ->where('staff',$value['name'])
                    ->whereNotIn('status',['S','T'])
                    ->where('statusERP','N')
                    ->when($start, function ($query) use ($start,$end) {
                        return $query->whereBetween('thisDate',[$start,$end]);
                    })
                    ->get();

                $c = CycleAssign::where('organization_name',$dept[0]['name'])
                    ->where('staff',$value['name'])
                    ->where('statusERP','N')
                    ->when($start, function ($query) use ($start,$end) {
                        return $query->whereBetween('thisDate',[$start,$end]);
                    })
                    ->get();

                $d = CycleAssign::where('organization_name',$dept[0]['name'])
                    ->where('staff',$value['name'])
                    ->where('status','T')
                    ->where('statusERP','N')
                    ->when($start, function ($query) use ($start,$end) {
                        return $query->whereBetween('thisDate',[$start,$end]);
                    })
                    ->get();

                foreach ($c as $keyy => $valuee) {
                   if(!in_array(explode('-', $valuee->kind)[0], $allcardArray)){
                        array_push($allcardArray, explode('-', $valuee->kind)[0]);
                    } 
                }

                foreach ($a as $kk => $vv) {
                    if(!in_array(explode('-', $vv->kind)[0], $kindStillArray)){
                        array_push($kindStillArray, explode('-', $vv->kind)[0]);
                    }
                }

                foreach ($b as $kks => $vvs) {
                    if(!in_array(explode('-', $vvs->kind)[0], $kindFinishArray)){
                        array_push($kindFinishArray, explode('-', $vvs->kind)[0]);
                    }
                }

                foreach ($d as $kkss => $vvss) {
                    if(!in_array(explode('-', $vvss->kind)[0], $turnCardArray)){
                        array_push($turnCardArray, explode('-', $vvss->kind)[0]);
                    }
                }

                // $kindStillImp = implode(',', $kindStillArray);

                // if($kindStillImp){
                //     foreach ($kindFinishArray as $kkk => $vvv) {
                //         if(!strstr($kindStillImp,$vvv)){
                //             if(!in_array($vvv, $kindFinishNotStillArray)){
                //                 array_push($kindFinishNotStillArray, $vvv);
                //             }
                //         }
                //     }
                // }
                // else{
                //     $kindFinishNotStillArray = $kindFinishArray;
                // }

                $staffNowArray[$value['name']]['still'] = count($kindStillArray);
                $staffNowArray[$value['name']]['finish'] = count($kindFinishArray);
                $staffNowArray[$value['name']]['turn'] = count($turnCardArray);
                $staffNowArray[$value['name']]['count'] = count($allcardArray);

        }

        return $staffNowArray;
    }

    public function dashSearch(Organization $organization,Request $request)
    {

        $start = $request->start;
        $end = $request->end;

        $dept = Organization::where('id',$organization->id)->get();

        //全部分公司使用者
        $allUser = User::whereIn('job',['助理','主管','員工','業務'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        //全站卡片數據狀態-執行中&已完成
       $allFinishCase = CycleAssign::where('organization_name',$dept[0]['name'])
                        ->where('status','F')
                        ->where('statusERP','N')
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('thisDate',[$start,$end]);
                        })
                        ->get();
       $allStillCase = CycleAssign::where('organization_name',$dept[0]['name'])
                        ->where('status','S')
                        ->where('statusERP','N')
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('thisDate',[$start,$end]);
                        })
                        ->get();

       $allFinishCaseArray = array();
       $allStillCaseArray = array();
       $allFinishNotStillArray = array();
       $allCardStatusArray = array();

       foreach ($allFinishCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allFinishCaseArray)){
                array_push($allFinishCaseArray, explode('-',$value->kind)[0]);
            }
       }

       foreach ($allStillCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allStillCaseArray)){
                array_push($allStillCaseArray, explode('-',$value->kind)[0]);
            }
       }

       // $allStillCaseImp = implode(',', $allStillCaseArray);

       // if($allStillCaseImp){
       //      foreach ($allFinishCaseArray as $kkk => $vvv) {
       //          if(!strstr($allStillCaseImp,$vvv)){
       //              if(!in_array($vvv, $allFinishNotStillArray)){
       //                  array_push($allFinishNotStillArray, $vvv);
       //              }
       //          }
       //      }
       //  }
       //  else{
       //      $allFinishNotStillArray = $allFinishCaseArray;
       //  }

        //週期儀錶板
        $fff = array();

        
        foreach ($deptUser as $keyss => $valuess) {

            $f = CycleAssign::where('organization_name',$dept[0]['name'])
                ->where('staff',$valuess['name'])->where('status','F')
                ->where('statusERP','N')
                ->when($start, function ($query) use ($start,$end) {
                    return $query->whereBetween('thisDate',[$start,$end]);
                })
                ->get();

            $fff[$valuess['name']]['finish'] = 0;
            $done = array();

            foreach ($f as $keysss => $valuesss) {
                foreach ($allFinishCaseArray as $keys => $values) {

                    if(explode('-',$valuesss->kind)[0] == $values && $valuesss->staff == $valuess['name']){
                        if(!in_array(explode('-',$valuesss->kind)[0], $done)){
                            array_push($done, explode('-',$valuesss->kind)[0]);
                            $fff[$valuess['name']]['finish'] += 1;
                        }
                    }
                }
            }
        }

        $bbb = array();

        if($allFinishCaseArray == null){
            foreach ($fff as $key => $value) {
               $bbb[$key]['result'] = 0;
            }
        }
        else{
            foreach ($fff as $key => $value) {
               $bbb[$key]['result'] = round(($value['finish']/count($allFinishCaseArray))*100,2);
            }
        }

       $allCardStatusArray = [array("category"=>"已完成","column-1"=>count($allFinishCaseArray)),array("category"=>"執行中","column-1"=>count($allStillCaseArray))];

        //全站卡片數據狀態-轉單
        $allTurnCase = CycleAssign::where('organization_name',$dept[0]['name'])
                        ->where('status','T')->where('statusERP','N')
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('thisDate',[$start,$end]);
                        })
                        ->get();
        $allTurnCaseArray = array();
        $allCardTurnArray = array();
        $allNotTurnCardArray = array();

        foreach ($allTurnCase as $key => $value) {

            if(!in_array(explode('-',$value->kind)[0], $allTurnCaseArray)){
                array_push($allTurnCaseArray, explode('-',$value->kind)[0]);
            }
        }

        $ttt = array();

        
            foreach ($deptUser as $keyss => $valuess) {

                $t = CycleAssign::where('organization_name',$dept[0]['name'])
                    ->where('staff',$valuess['name'])->where('status','T')
                    ->where('statusERP','N')
                    ->when($start, function ($query) use ($start,$end) {
                        return $query->whereBetween('thisDate',[$start,$end]);
                    })
                    ->get();

                $ttt[$valuess['name']]['turn'] = 0;
                $done = array();

                foreach ($t as $keysss => $valuesss) {

                    foreach ($allTurnCaseArray as $keys => $values) {

                        if(explode('-',$valuesss->kind)[0] == $values && $valuesss->staff == $valuess['name']){
                            if(!in_array(explode('-',$valuesss->kind)[0], $done)){
                                array_push($done, explode('-',$valuesss->kind)[0]);
                                $ttt[$valuess['name']]['turn'] += 1;
                            }
                        }
                    }
                }
            }

        $ccc = array();

        if($allTurnCaseArray == null){
            foreach ($ttt as $key => $value) {
               $ccc[$key]['result'] = 0;
            }
        }
        else{
            foreach ($ttt as $key => $value) {
               $ccc[$key]['result'] = round(($value['turn']/count($allTurnCaseArray))*100,2);
            }
        }

        $allNotTurnCard = CycleAssign::where('organization_name',$dept[0]['name'])
                        ->where('status','!=','T')->where('statusERP','N')
                        ->when($start, function ($query) use ($start,$end) {
                            return $query->whereBetween('thisDate',[$start,$end]);
                        })
                        ->get();
        foreach ($allNotTurnCard as $key => $value) {
            if(!in_array(explode('-',$value->kind)[0], $allNotTurnCardArray)){
                array_push($allNotTurnCardArray, explode('-',$value->kind)[0]);
            }
        }

        $allCardTurnArray = [array("category"=>"轉單","column-1"=>count($allTurnCaseArray)),array("category"=>"正常接單","column-1"=>count($allNotTurnCardArray))];

        $countFinishArray = count($allFinishCaseArray);
        $countTurnArray = count($allTurnCaseArray);

        return [$countFinishArray,$bbb,$countTurnArray,$ccc,$allCardStatusArray,$allCardTurnArray];
    }
}
