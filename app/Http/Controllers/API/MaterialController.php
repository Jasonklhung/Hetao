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
    		$material = array("status"=>200);

    		foreach ($receive as $key => $value) {
    			$material["receive"][] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$value->date,"emp_id"=>$value->emp_id,"emp_name"=>$value->emp_name,"materials_number"=>$value->materials_number,"materials_spec"=>$value->materials_spec,"machine_number"=>$value->machine_number,"quantity"=>$value->quantity,"other"=>$value->other);
    		}

    		foreach ($back as $k => $v) {
    			$material["back"][] = array("id"=>$value->id,"dept"=>$value->organization_name,"date"=>$v->date,"emp_id"=>$v->emp_id,"emp_name"=>$v->emp_name,"materials_number"=>$v->materials_number,"materials_spec"=>$v->materials_spec,"machine_number"=>$v->machine_number,"quantity"=>$v->quantity,"other"=>$v->other);
    		}

    		return $material;
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

    		if($type == 'receive'){

    			$update = Material::where('id', '=', $id)->update(['status' => 'Y']);

    			$res = Material::where('id',$id);
    		}
    		elseif($type == 'back'){

    			$update = MaterialBack::where('id', '=', $id)->update(['status' => 'Y']);

    			$res = MaterialBack::where('id',$id);
    		}
    	}
    	elseif(empty($id) && !empty($date && empty($dept))){

    		if($type == 'receive'){

    			$update = Material::whereDate('date', '=', $date)->update(['status' => 'Y']);

    			$res = Material::whereDate('date','=', $date)->get();
    		}
    		elseif($type == 'back'){

    			$update = MaterialBack::whereDate('date', '=', $date)->update(['status' => 'Y']);

    			$res = MaterialBack::whereDate('date','=', $date)->get();
    		}
    	}
    	elseif(empty($id) && !empty($date) && !empty($dept)){

    		if($type == 'receive'){

    			$update = Material::whereDate('date', '=', $date)->where('organization_name',$dept)->update(['status' => 'Y']);

    			$res = Material::whereDate('date','=', $date)->where('organization_name',$dept)->get();

    		}
    		elseif($type == 'back'){

    			$update = MaterialBack::whereDate('date', '=', $date)->where('organization_name',$dept)->update(['status' => 'Y']);

    			$res = MaterialBack::whereDate('date','=', $date)->where('organization_name',$dept)->get();
    		}
    	}
    	elseif(empty($id) && empty($date) && !empty($dept)){
    		return json_encode(array("status" => 400 , "message" => "缺少date參數"));
    	}

    	$material = array("status"=>200);

    	foreach ($res as $key => $value) {
    		$material["data"][] = array("id"=>$value->id,"dept"=>$value['organization_name'],"materials_number"=>$value->materials_number,"materials_spec"=>$value->materials_spec,"machine_number"=>$value->machine_number,"quantity"=>$value->quantity,"other"=>$value->other,"status"=>$value->status);
    	}

    	return $material;
    }
}
