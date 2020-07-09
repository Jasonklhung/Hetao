<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CycleFinish;
use App\CycleTurn;
use App\CycleAssign;

class CycleController extends Controller
{
    public function get_cycle_detail(Request $request)
    {
    	$date = $request->date;
    	$dept = $request->dept;

    	if(empty($date) && empty($dept)){

    		$finish = CycleAssign::where('status','F')->get();
    		$turn = CycleAssign::where('status','T')->get();
    	}
    	elseif(empty($date) && !empty($dept)){

    		$finish = CycleAssign::where('organization_name',$dept)->where('status','F')->get();
    		$turn = CycleAssign::where('organization_name',$dept)->where('status','T')->get();
    	}
    	elseif(!empty($date) && empty($dept)){

    		$finish = CycleAssign::whereDate('thisDate','=',$date)->where('status','F')->get();
    		$turn = CycleAssign::whereDate('thisDate','=',$date)->where('status','T')->get();
    	}
    	else{

    		$finish = CycleAssign::where('organization_name',$dept)->whereDate('thisDate','=',$date)->where('status','F')->get();
    		$turn = CycleAssign::where('organization_name',$dept)->whereDate('thisDate','=',$date)->where('status','T')->get();
    	}

    	if($finish->isEmpty() && $turn->isEmpty()){
    		return json_encode(array("status" => 400 , "message" => "沒有符合的資料"));
    	}
    	else{
    		$cycle = array();

    		foreach ($finish as $key => $value) {
    			$cycle[] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->thisDate,"category"=>$value->kind,"custkey"=>$value->custkey,"staff"=>$value->staff,"status"=>$value->status,"statusERP"=>$value->statusERP);
    		}

    		foreach ($turn as $k => $v) {
    			$cycle[] = array("id"=>$v->id,"dept"=>$v->organization_name,"date"=>$v->thisDate,"category"=>$v->kind,"custkey"=>$v->custkey,"reason"=>$v->turnReason,"staff"=>$v->staff,"status"=>$v->status,"statusERP"=>$v->statusERP);
    		}

    		return $cycle;
    	}
    }

    public function cycle_update(Request $request)
    {

        $data = $request->data;

        foreach ($data as $key => $value) {

            if($value['type'] == 'finish'){

                $res = CycleAssign::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->statusERP = 'Y';
                    $res->save();
                }
            }
            elseif($value['type'] == 'turn'){

                $res = CycleAssign::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->statusERP = 'Y';
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
