<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Satisfaction;
use App\SatisfactionAnswer;
use App\Department;

class SatisfactionController extends Controller
{
    public function index(Request $request)
    {
        $data = Satisfaction::where('organization_id',$request->organization_id)->get();

        return $data;
    }

    public function store(Request $request)
    {

    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[] = $value;
        }

    	$id = Account::where('token',$request->token)->get();

    	$res = new SatisfactionAnswer;
        $res->department_id = $request->DEPT;
    	$res->account_id = $id[0]['id'];
    	$res->form = json_encode($form);
        $res->case_id = $request->case_id;
        $res->owner = $request->owner;
    	$res->save();   

    	return 'ok';
    }

    public function show()
    {
        $data = SatisfactionAnswer::all();
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
            $result[$key]['case_id'] = $value->case_id;
            $result[$key]['DEPT'] = $dept->name;
            $result[$key]['CUSTKEY'] = $account->cuskey;
            $result[$key]['name'] = $account->name;
            $result[$key]['CARDNO'] = $account->card_number;
            $result[$key]['data'] = $res;
            $result[$key]['status'] = $value->status;

        }

        return $result;
    }
}
