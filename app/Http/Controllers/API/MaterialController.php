<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Material;
use App\MaterialBack;
use App\MaterialStock;
use App\Organization;

class MaterialController extends Controller
{
    public function get_material_detail(Request $request)
    {
    	$date = $request->date;
    	$dept = $request->dept;

    	if(empty($date) && empty($dept)){

    		$receive = Material::all();
    		$back = MaterialBack::all();
    	}
    	elseif(empty($date) && !empty($dept)){

    		$receive = Material::where('organization_name',$dept)->get();
    		$back = MaterialBack::where('organization_name',$dept)->get();
    	}
    	elseif(!empty($date) && empty($dept)){

    		$receive = Material::whereDate('date','=',$date)->get();
    		$back = MaterialBack::whereDate('date','=',$date)->get();
    	}
    	else{

    		$org = Organization::where('name',$dept)->get();
    		$org_id = $org[0]['id'];
    		$receive = Material::where('organization_name',$dept)->whereDate('date','=',$date)->get();
    		$back = MaterialBack::where('organization_name',$dept)->whereDate('date','=',$date)->get();
    	}

    	if($receive->isEmpty() && $back->isEmpty()){
    		return json_encode(array("status" => 400 , "message" => "沒有符合的資料"));
    	}
    	else{
    		$material = array();

    		foreach ($receive as $key => $value) {
    			$material[] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->date,"emp_id"=>$value->emp_id,"emp_name"=>$value->emp_name,"materials_number"=>$value->materials_number,"materials_spec"=>$value->materials_spec,"machine_number"=>$value->machine_number,"quantity"=>$value->quantity,"other"=>$value->other,'status'=>'R',"statusYN"=>$value->status,"statusDL"=>$value->statusDL,"statusERP"=>$value->statusERP);
    		}

    		foreach ($back as $k => $v) {
    			$material[] = array("id"=>$v->id,"dept"=>$v->organization_name,"date"=>$v->date,"emp_id"=>$v->emp_id,"emp_name"=>$v->emp_name,"materials_number"=>$v->materials_number,"materials_spec"=>$v->materials_spec,"machine_number"=>$v->machine_number,"quantity"=>$v->back_quantity,"other"=>$v->other,"status"=>'B',"statusYN"=>$v->status,"statusDL"=>$v->statusDL,"statusERP"=>$v->statusERP);
    		}

    		return $material;
    	}
    }

    public function material_update(Request $request)
    {

        $data = $request->data;

        foreach ($data as $key => $value) {

            if($value['type'] == 'receive'){

                $res = Material::find($value['id']);

                if($res == null){
                    return json_encode(array('status' => 400, 'message' => '無效的id')) ;
                }
                else{
                    $res->statusERP = 'Y';
                    $res->save();
                }
            }
            elseif($value['type'] == 'back'){

                $res = MaterialBack::find($value['id']);

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
