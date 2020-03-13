<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CycleFinish;
use App\CycleTurn;

class CycleController extends Controller
{
    public function get_cycle_detail(Request $request)
    {
    	$date = $request->date;
    	$dept = $request->dept;

    	if(empty($date) && empty($dept)){

    		$finish = CycleFinish::all();
    		$turn = CycleTurn::all();
    	}
    	elseif(empty($date) && !empty($dept)){

    		$finish = CycleFinish::where('organization_name',$dept)->get();
    		$turn = CycleTurn::where('organization_name',$dept)->get();
    	}
    	elseif(!empty($date) && empty($dept)){

    		$finish = CycleFinish::whereDate('date','=',$date)->get();
    		$turn = CycleTurn::whereDate('date','=',$date)->get();
    	}
    	else{

    		$finish = CycleFinish::where('organization_name',$dept)->whereDate('date','=',$date)->get();
    		$turn = CycleTurn::where('organization_name',$dept)->whereDate('date','=',$date)->get();
    	}

    	if($finish->isEmpty() && $turn->isEmpty()){
    		return json_encode(array("status" => 400 , "message" => "沒有符合的資料"));
    	}
    	else{
    		$cycle = array("status"=>200);

    		foreach ($finish as $key => $value) {
    			$cycle["finish"][] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->date,"category"=>$value->category,"custkey"=>$value->custkey,"status"=>$value->status);
    		}

    		foreach ($turn as $k => $v) {
    			$cycle["turn"][] = array("id"=>$v->id,"dept"=>$v->organization_name,"date"=>$v->date,"category"=>$v->category,"custkey"=>$v->custkey,"status"=>$v->status);
    		}

    		return $cycle;
    	}
    }

    public function cycle_update(Request $request)
    {
    	$id = $request->id;
    	$type = $request->type;

    	if(empty($type)){
    		return json_encode(array("status" => 400 , "message" => "缺少type參數"));
    	}
    	elseif(empty($id)){
    		return json_encode(array("status" => 400 , "message" => "缺少id參數"));
    	}

    	$result = array();

    	if($type == 'finish'){

    		foreach ($id as $key => $value) {
    			$update = CycleFinish::where('id', '=', $value)->update(['status' => 'Y']);

    			if($update == true){
    				array_push($result, $value);
    			}
    		}
    	}
    	elseif($type == 'turn'){

    		foreach ($id as $key => $value) {
    			$update = CycleTurn::where('id', '=', $value)->update(['status' => 'Y']);

    			if($update == true){
    				array_push($result, $value);
    			}
    		}
    	}

    	$result = implode(',', $result);

    	if(!empty($result)){
    		return json_encode(array("status" => 200 , "message" => "id:".$result."更新成功"));
    	}
    	else{
    		return json_encode(array("status" => 400 , "message" => "查無可更新的資料"));
    	}
    }
}
