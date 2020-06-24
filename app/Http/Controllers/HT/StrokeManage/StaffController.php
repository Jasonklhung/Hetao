<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\TransferCase;
use App\User;
use App\Department;
use App\SupervisorCase;

use Auth;
use GuzzleHttp\Client;

class StaffController extends Controller
{
    public function index(Organization $organization)
    {
        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
            // $client = new \GuzzleHttp\Client();
            // $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
            //     'headers' => ['Content-Type' => 'application/json'],
            //     'body' => json_encode([
            //     'token' => Auth::user()->token,//Auth::user()->token,
            //     'DEPT' => $dept[0]['name']//$organization->name
            // ])
            // ]);

            // $response = $response->getBody()->getContents();

            // $data = json_decode($response);

            // $countArray = array();

            // foreach ($data as $key => $value) {
            //     if($key == 'data'){
            //         $array = $value;

            //         foreach ($array as $k => $v) {
            //             if($v->status == null || $v->status == '' || $v->status == 'F'){
            //                 array_push($countArray,$v);
            //             }
            //         }
            //     }
            // }

            $countArray = SupervisorCase::where('owner_id',Auth::user()->id)->whereIn('status',[null,'','F'])->get();

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

        //取得個人工單
        $case = SupervisorCase::where('organization_id',$organization->id)->where('owner_id',Auth::user()->id)->whereIn('status',['',null,'F'])->get();

        //個人工單進度
        $caseFinish = SupervisorCase::where('organization_id',$organization->id)->where('owner_id',Auth::user()->id)->where('status','T')->get();

    	return view('ht.StrokeManage.staff.index',compact('organization','caseCount','case','caseFinish'));
    }

    public function getData(Organization $organization,Request $request)
    {
        // $client = new \GuzzleHttp\Client();
        // $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
        //     'headers' => ['Content-Type' => 'application/json'],
        //     'body' => json_encode([
        //         'token' => $request->token,
        //         'DEPT' => $request->DEPT
        //     ])
        // ]);

        // $response = $response->getBody()->getContents();

        // return $response;
        $case = SupervisorCase::where('organization_id',$request->org_id)->where('owner_id',$request->user_id)->get();

        return $case;
    }

    public function updateStatus(Organization $organization,Request $request)
    {

        //update
        $super = SupervisorCase::where('case_id',$request->id)->get();
        if($super->isNotEmpty()){
            $supervisor = SupervisorCase::find($super[0]['id']);
            $supervisor->status = $request->status;
            $supervisor->save();
        }else{
            
        }

        //api
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => $request->token,
                'id' => $request->id,
                'status'=> $request->status,
                'DEPT' => $request->DEPT
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function transfer(Organization $organization,Request $request)
    {
        // $name = TransferCase::where('case_id',$request->id)->get();

        // $user_id = $name[0]['user_id'];

        // $user = User::where('id',$user_id)->get();

        // $dept = Department::where('id',$user[0]['department_id']);

        //api
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/assign-case-boss', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'id' => $request->id,
                'name' => $request->name,
                'mobile'=> $request->mobile,
                'GUI_number' => $request->GUI_number,
                'address' => $request->address,
                'work_type' => $request->work_type,
                'time' => $request->time,
                'owner_boss' => '',//$user[0]['token'],
                'DEPT' => $organization->name,//$user[0]['department_id'],
            ])
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'id' => $request->id,
                'status'=> '',
                'DEPT' => $organization->name//$organization->name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        return $response;
    }

    public function updateCaseStatus(Organization $organization,Request $request)
    {
        //dd($request->all());

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/update-case-status', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'id' => $request->case_id,
                'status'=> $request->status,
                'DEPT' => $organization->name//$organization->name,
            ])
        ]);

        $response = $response->getBody()->getContents();

        if(json_decode($response)->status == 200){
            //DB
            $supervisor = SupervisorCase::find($request->id);
            $supervisor->status = $request->status;
            $supervisor->save();

            return array("status"=>200);
        }
        else{
            return array("status"=>400);
        }
    }

    public function reportAssignSearch(Organization $organization,Request $request)
    {
        //dd($request->all());
        $start = $request->start;
        $end = $request->end;

        //取得個人工單
        $case = SupervisorCase::where('organization_id',$organization->id)
                                ->where('owner_id',Auth::user()->id)
                                ->whereIn('status',['',null,'F'])
                                ->when($start, function ($query) use ($start,$end) {
                                    return $query->whereBetween('time',[$start,$end]);
                                })
                                ->get();

        return $case;
    }

    public function assignCaseSearch(Organization $organization,Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $caseFinish = SupervisorCase::where('organization_id',$organization->id)
                                    ->where('owner_id',Auth::user()->id)
                                    ->where('status','T')
                                    ->when($start, function ($query) use ($start,$end) {
                                        return $query->whereBetween('time',[$start,$end]);
                                    })
                                    ->get();

        return $caseFinish;
    }
}
