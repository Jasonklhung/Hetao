<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Satisfaction;
use App\SatisfactionAnswer;

class SatisfactionController extends Controller
{
    public function index()
    {
        $data = Satisfaction::all();

        return $data;
    }

    public function store(Request $request)
    {
    	$form = array();

    	// foreach ($request->form as $key => $value) {

    	// 	if(preg_match("/^radio+[0-9]+$/", $value->name)){ //radio
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^select+[0-9]+$/", $value->name)){ //select
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^multi+[0-9]+$/", $value->name)){ //multi
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^qa+[0-9]+$/", $value->name)){ //qa
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^part+[0-9]+$/", $value->name)){ //part
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^date+[0-9]+$/", $value->name)){ //date
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// 	elseif(preg_match("/^time+[0-9]+$/", $value->name)){ //time
    	// 		foreach ($request->form as $k => $v) {
    	// 			if(preg_match("/^$value->name+Opt+$/", $v->name)){

    	// 				$form[] = [$value->value=>$v->value];
    	// 			}
    	// 		}
    	// 	}
    	// }


    	// $id = Account::where('token',$request->token)->get();

    	// $res = new SatisfactionAnswer;
    	// $res->account_id = $id[0]['id'];
    	// $res->form = json_encode($form);
    	// $res->save();   

    	return $request->form;
    }
}
