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
use App\User;

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
                'DEPT' => $dept[0]['name']//$organization->name
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
                'DEPT' => $dept[0]['name']//$organization->name
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

        //全部分公司使用者
        $allUser = User::whereIn('job',['助理','主管','員工','業務'])->get();
        $deptUser = array();

        foreach ($allUser as $key => $value) {
            if($value->organization_id == $dept[0]['id']){
                $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
            }
        }

        foreach ($allUser as $key => $value) {
            $many = explode(',', $value->organizations);

            foreach ($many as $k => $v) {
                if($v == $dept[0]['id'] && $value->organization_id != $dept[0]['id']){
                    $deptUser[] = array("id"=>$value->id,"name"=>$value->name);
                }
            }
        }

        return view('ht.Material.case.index',compact('organization','caseCount','materialing','materialFinish','materialBack','materialBackFinish','deptUser'));
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

    public function materialingSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $status = $request->status;
        $staff = $request->staff;

        //領料待處理
        $dept = Organization::where('id',$organization->id)->get(); //取得組織id

        $materialing = Material::where('organization_name',$dept[0]['name'])
                                    ->where('status','N')
                                    ->when($start, function ($query) use ($start,$end) {
                                        return $query->whereBetween('date',[$start,$end]);
                                    })
                                    ->when($status, function ($query) use ($status) {
                                        return $query->where('statusEdit',$status);
                                    })
                                    ->when($staff, function ($query) use ($staff) {
                                        return $query->where('user_id',$staff);
                                    })
                                    ->get();

        return $materialing;

    }

    public function materialFinishSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $statusDL = $request->statusDL;
        $statusERP = $request->statusERP;
        $staff = $request->staff;

        //領料已完成
        $dept = Organization::where('id',$organization->id)->get(); //取得組織id

        $materialFinish = Material::where('organization_name',$dept[0]['name'])
                                        ->where('status','Y')
                                        ->when($start, function ($query) use ($start,$end) {
                                            return $query->whereBetween('date',[$start,$end]);
                                        })
                                        ->when($statusDL, function ($query) use ($statusDL) {
                                            return $query->where('statusDL',$statusDL);
                                        })
                                        ->when($statusERP, function ($query) use ($statusERP) {
                                            return $query->where('statusERP',$statusERP);
                                        })
                                        ->when($staff, function ($query) use ($staff) {
                                            return $query->where('user_id',$staff);
                                        })
                                        ->get();

        return $materialFinish;
    }

    public function materialBackSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $staff = $request->staff;

        //退料待處理
        $dept = Organization::where('id',$organization->id)->get(); //取得組織id

        $materialBack = MaterialBack::where('organization_name',$dept[0]['name'])
                                        ->when($start, function ($query) use ($start,$end) {
                                            return $query->whereBetween('date',[$start,$end]);
                                        })
                                        ->when($staff, function ($query) use ($staff) {
                                            return $query->where('user_id',$staff);
                                        })
                                        ->where('status','N')
                                        ->get();

        return $materialBack;
    }

    public function materialBackFinishSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $statusDL = $request->statusDL;
        $statusERP = $request->statusERP;
        $staff = $request->staff;

        //領料已完成
        $dept = Organization::where('id',$organization->id)->get(); //取得組織id

         $materialBackFinish = MaterialBack::where('organization_name',$dept[0]['name'])
                                                ->where('status','Y')
                                                ->when($start, function ($query) use ($start,$end) {
                                                    return $query->whereBetween('date',[$start,$end]);
                                                })
                                                ->when($statusDL, function ($query) use ($statusDL) {
                                                    return $query->where('statusDL',$statusDL);
                                                })
                                                ->when($statusERP, function ($query) use ($statusERP) {
                                                    return $query->where('statusERP',$statusERP);
                                                })
                                                ->when($staff, function ($query) use ($staff) {
                                                    return $query->where('user_id',$staff);
                                                })
                                                ->get();

        return $materialBackFinish;
    }
}
