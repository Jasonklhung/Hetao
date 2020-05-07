<?php

namespace App\Http\Controllers\HT\Material;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;
use Auth;
use App\Material;
use App\MaterialBack;
use App\Exports\MaterialDownloadExport;
use App\Exports\MaterialBackDownloadExport;
use Maatwebsite\Excel\Facades\Excel;

class CaseController extends Controller
{
    public function index(Organization $organization)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => $dept[0]['name']//Auth::user()->department->name//Auth::user()->department->name
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
                'DEPT' => $dept[0]['name']//Auth::user()->department->name//Auth::user()->department->name
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

        //領料待處理
        $dept = Organization::where('id',$organization->id)->get(); //取得組織id
        $materialing = Material::where('organization_name',$dept[0]['name'])->where('status','N')->get();

        //領料已完成
        $materialFinish = Material::where('organization_name',$dept[0]['name'])->where('status','Y')->get();

        //退料待處理
        $materialBack = MaterialBack::where('organization_name',$dept[0]['name'])->where('status','N')->get();

        //退料已完成
        $materialBackFinish = MaterialBack::where('organization_name',$dept[0]['name'])->where('status','Y')->get();

        return view('ht.Material.case.index',compact('organization','caseCount','materialing','materialFinish','materialBack','materialBackFinish'));
    }

    public function material_edit(Organization $organization,Request $request)
    {
        $material = Material::find($request->id);
        $material->materials_number = $request->materials_number;
        $material->materials_spec = $request->materials_spec;
        $material->machine_number = $request->machine_number;
        $material->quantity = $request->quantity;
        $material->statusEdit = 'Y';
        $material->save();

        return redirect()->route('ht.Material.case.index',compact('organization'))->with('success','領料單已編輯');
    }

    public function material_confirm(Organization $organization,Request $request)
    {
        $material = Material::find($request->id);
        $material->status = 'Y';
        $material->save();

        return array('status'=>200);
    }

    public function material_download(Organization $organization,Request $request)
    {
        $today = date('Y-m-d');

        return (new MaterialDownloadExport)->search($request->id)->download($today.'報備明細表.xlsx');
    }

    public function materialBackEdit(Organization $organization,Request $request)
    {
        $material = MaterialBack::find($request->back_id);
        $material->materials_number = $request->back_materials_number;
        $material->materials_spec = $request->back_materials_spec;
        $material->machine_number = $request->back_machine_number;
        $material->quantity = $request->quantity;
        $material->back_quantity = $request->back_quantity;
        $material->statusEdit = 'Y';
        $material->save();

        return redirect()->route('ht.Material.case.index',compact('organization'))->with('success','退料單已編輯');
    }

    public function materialBackConfirm(Organization $organization,Request $request)
    {
        $material = MaterialBack::find($request->id);
        $material->status = 'Y';
        $material->save();

        return array('status'=>200);
    }

    public function materialBackDownload(Organization $organization,Request $request)
    {
        $today = date('Y-m-d');

        return (new MaterialBackDownloadExport)->search($request->id)->download($today.'報備明細表.xlsx');
    }
}
