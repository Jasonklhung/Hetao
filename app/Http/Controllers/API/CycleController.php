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

    	if($receive->isEmpty() && $back->isEmpty()){
    		return json_encode(array("status" => 400 , "message" => "沒有符合的資料"));
    	}
    	else{
    		$cycle = array("status"=>200);

    		foreach ($finish as $key => $value) {
    			$cycle["finish"][] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->date,"category"=>$value->category,"custkey"=>$value->custkey,"status"=>$value->status);
    		}

    		foreach ($turn as $k => $v) {
    			$cycle["turn"][] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->date,"category"=>$value->category,"custkey"=>$value->custkey,"status"=>$value->status);
    		}

    		return $cycle;
    	}
    }

    public function material_update(Request $request)
    {
    	$id = $request->id;
    	$type = $request->type;
    	$dept = $request->dept;
    	$date = $request->date;

    	if(empty($type)){
    		return json_encode(array("status" => 400 , "message" => "缺少type參數"));
    	}
    	elseif(!empty($id) && !empty($type)){

    		if($type == 'finish'){

    			$update = CycleFinish::where('id', '=', $id)->update(['status' => 'Y']);

    			$res = CycleFinish::where('id',$id)->get();
    		}
    		elseif($type == 'turn'){

    			$update = CycleTurn::where('id', '=', $id)->update(['status' => 'Y']);

    			$res = CycleTurn::where('id',$id)->get();
    		}
    		else{
    			return json_encode(array("status" => 400 , "message" => "無效的type參數"));
    		}
    	}
    	elseif(empty($id) && !empty($date && empty($dept))){

    		if($type == 'finish'){

    			$update = CycleFinish::whereDate('date', '=', $date)->update(['status' => 'Y']);

    			$res = CycleFinish::whereDate('date','=', $date)->get();
    		}
    		elseif($type == 'turn'){

    			$update = CycleTurn::whereDate('date', '=', $date)->update(['status' => 'Y']);

    			$res = CycleTurn::whereDate('date','=', $date)->get();
    		}
    		else{
    			return json_encode(array("status" => 400 , "message" => "無效的type參數"));
    		}
    	}
    	elseif(empty($id) && !empty($date) && !empty($dept)){

    		if($type == 'finish'){

    			$update = CycleFinish::whereDate('date', '=', $date)->where('organization_name',$dept)->update(['status' => 'Y']);

    			$res = CycleFinish::whereDate('date','=', $date)->where('organization_name',$dept)->get();

    		}
    		elseif($type == 'turn'){

    			$update = CycleTurn::whereDate('date', '=', $date)->where('organization_name',$dept)->update(['status' => 'Y']);

    			$res = CycleTurn::whereDate('date','=', $date)->where('organization_name',$dept)->get();
    		}
    		else{
    			return json_encode(array("status" => 400 , "message" => "無效的type參數"));
    		}
    	}
    	elseif(empty($id) && empty($date) && !empty($dept)){
    		return json_encode(array("status" => 400 , "message" => "缺少date參數"));
    	}

    	if($res->isNotEmpty()){
    		$cycle = array("status"=>200);

    		foreach ($res as $key => $value) {
    			$cycle["data"][] = array("id"=>$value->id,"dept"=>$value['organization_name'],"materials_number"=>$value->materials_number,"materials_spec"=>$value->materials_spec,"machine_number"=>$value->machine_number,"quantity"=>$value->quantity,"other"=>$value->other,"status"=>$value->status);
    		}

    		return $cycle;
    	}
    	else{
    		return json_encode(array("status" => 400 , "message" => "沒有符合的資料"));
    	}
    }
}
