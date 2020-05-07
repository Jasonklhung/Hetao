<?php

namespace App\Http\Controllers\HT\Material;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\MaterialStock;
use App\MaterialBack;
use App\Material;

class MaterialController extends Controller
{
    public function index(Organization $organization)
    {
    	$job = Auth::user()->job;
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
            ]);

            $response = $response->getBody()->getContents();

            $data = json_decode($response);

            $countArray = array();

            foreach ($data as $key => $value) {
                if($key == 'data'){
                    $array = $value;

                    foreach ($array as $k => $v) {
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }else{
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
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

        //個人領料資訊
        $dept = Organization::where('id',$organization->id)->get();

        $materialN =  Material::where('user_id',Auth::user()->id)->where('organization_name',$dept[0]['name'])->where('status','N')->get();

        $materialY =  Material::where('user_id',Auth::user()->id)->where('organization_name',$dept[0]['name'])->where('status','Y')->get();

        return view('ht.Material.material.index',compact('organization','caseCount','materialN','materialY'));
    }

    public function materialsNumberSearch(Organization $organization,Request $request)
    {
        $dept = Organization::where('id',$organization->id)->get();

        $res = MaterialStock::where('organization_name',$dept[0]['name'])->where('materials_number','like','%'.$request->value.'%')->get();


        $result = array();

        foreach ($res as $key => $value) {
            array_push($result, $value['materials_number']);
        }

        $spec = MaterialStock::where('organization_name',$dept[0]['name'])->where('materials_number',$request->value)->get();

        return [$result,$spec];
    }

    public function store(Organization $organization,Request $request)
    {

        $dept = Organization::where('id',$organization->id)->get();
        $name = $dept[0]['name'];

        $count = count($request->materials_number);

        for ($i=0; $i < $count ; $i++) { 

            $material = new Material;
            $material->user_id = Auth::user()->id;
            $material->organization_name = $name;
            $material->date = $request->date;
            $material->emp_id = $request->emp_id;
            $material->emp_name = $request->emp_name;

            $material->materials_number = $request->materials_number[$i];
            $material->materials_spec = $request->materials_spec[$i];
            ($request->machine_number[$i] == 'null')? $material->machine_number = '' : $material->machine_number = $request->machine_number[$i];
            $material->quantity = $request->quantity[$i];

            $material->save();

        }

        return redirect()->route('ht.Material.material.index',compact('organization'))->with('success','領料單已送出');
    }

    public function storeBack(Organization $organization,Request $request)
    {
        $res = Material::find($request->id);

        $back = new MaterialBack;
        $back->user_id = Auth::user()->id;
        $back->organization_name = $res->organization_name;
        $back->date = $request->back_date;
        $back->emp_id = $res->emp_id;
        $back->emp_name = $res->emp_name;
        $back->materials_number = $res->materials_number;
        $back->materials_spec = $res->materials_spec;
        $back->machine_number = $res->machine_number;
        $back->quantity = $res->quantity;
        $back->back_quantity = $request->back_quantity;
        $back->other = $res->other;
        $back->save();

        return redirect()->route('ht.Material.material.index',compact('organization'))->with('success','退料單已送出');
    }
}
