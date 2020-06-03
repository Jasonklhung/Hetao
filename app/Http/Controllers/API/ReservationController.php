<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Reservation;
use App\ReservationAnswer;
use App\SatisfactionAnswer;
use App\ContactAnswer;
use App\Department;
use App\Organization;

use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {

        $data = Reservation::where('organization_id',$request->organization_id)->get();

        return $data;
    }

    public function store(Request $request)
    {

    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[] = $value;
        }

    	$id = Account::where('token',$request->token)->get();

        //計算預約工單編號
        $date = Carbon::now()->format('Y-m-d');
        $caseDate = explode('-',$date)[0].explode('-',$date)[1].explode('-',$date)[2];
        $case = ReservationAnswer::where('department_id',$request->DEPT)->get();

        if($case->isNotEmpty()){
            foreach ($case as $key => $value) {
                $cDate = explode(' ', $value->created_at)[0];

                if($cDate == $date){
                    $all = ReservationAnswer::where('department_id',$request->DEPT)->whereDate('created_at',$date)->get();
                    $count = count($all)+1;
                    $count=str_pad($count,4,0,STR_PAD_LEFT); 
                    $number = $caseDate.$count;
                }
                else{
                    $number = $caseDate.'0001';
                }
            }
        }
        else{

            $caseDate = explode('-',$date)[0].explode('-',$date)[1].explode('-',$date)[2];
            $number = $caseDate.'0001';
        }

    	$res = new ReservationAnswer;
        $res->department_id = $request->DEPT;
    	$res->account_id = $id[0]['id'];
        $res->number = $number;
    	$res->form = json_encode($form);
    	$res->save();   

    	return 'ok';
    }

    public function show(Request $request)
    {
        $dept = $request->dept;

        $deptName = Department::where('name',$dept)->get();

        if($deptName->isEmpty()){
            return json_encode(array('status'=>200,'message'=>'This DEPT is not current'));
        }

        if(!isset($dept)){
            $data = ReservationAnswer::all();
        }else{
            $data = ReservationAnswer::where('department_id',$deptName[0]['id'])->get();
        }

        $result = array();
        $date = array();

        foreach ($data as $key => $value) {
            $dept =  Department::find($value->department_id);
            $account = Account::find($value->account_id);

            $res = array();

            $data = json_decode($value->form);

            foreach ($data as $k => $v) {
                foreach ($v as $kk => $vv) {
                    if(preg_match("/^radio+[0-9]+Question+$/", $vv->name)){
                        $radioName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$radioName+Question+$/", $rr->name)){
                                $res[$radioName]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$radioName+Opt$/", $rr->name)){
                                $res[$radioName]['answer'] = $rr->value;
                            }
                        }

                        $res = array_values($res);
                    }
                    elseif(preg_match("/^multi+[0-9]+Question+$/", $vv->name)){
                        $multiName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$multiName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$multiName+Opt$/", $rr->name)){
                                $res[explode('Opt', $rr->name)[0]]['answer'][] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^select+[0-9]+Question+$/", $vv->name)){
                        $selectName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$selectName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$selectName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^qa+[0-9]+Question+$/", $vv->name)){
                        $qaName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$qaName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$qaName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^part+[0-9]+Question+$/", $vv->name)){
                        $partName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$partName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$partName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^date+[0-9]+Question+$/", $vv->name)){
                        $dateName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$dateName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$dateName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^time+[0-9]+Question+$/", $vv->name)){
                        $timeName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$timeName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$timeName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                }
            }
            
            $result[$key]['id'] = $value->id;
            $result[$key]['case_id'] = $value->number;
            $result[$key]['DEPT'] = $dept->name;
            $result[$key]['CUSTKEY'] = $account->cuskey;
            $result[$key]['name'] = $account->name;
            $result[$key]['CARDNO'] = $account->card_number;
            $result[$key]['data'] = $res;
            $result[$key]['status'] = $value->status;
            $result[$key]['created_at'] = $value->created_at;

        }

        return $result;
    }

    public function update(Request $request)
    {
        $data = $request->data;

        foreach ($data as $key => $value) {

            if($value['type'] == 'reservation'){

                $res = ReservationAnswer::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->status = 'Y';
                    $res->save();
                }
            }
            elseif($value['type'] == 'satisfaction'){

                $res = SatisfactionAnswer::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->status = 'Y';
                    $res->save();
                }
            }
            elseif($value['type'] == 'contact'){
                
                $res = ContactAnswer::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->status = 'Y';
                    $res->save();
                }
            }
            else{
                return json_encode(array('status' => 400, 'message' => '無效的type')) ;
            }
        }

        return json_encode(array('status' => 200, 'message' => '更新成功')) ;
    }
}
