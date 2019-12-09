<?php

namespace App\Http\Controllers\HT\FormDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\Organization;
use App\SatisfactionAnswer;

class satisfactionSurveyController extends Controller
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
                        if($v->status == null || $v->owner == '' || $v->owner == 'F'){
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
                        if($v->owner == null || $v->owner == ''){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        $satisfaction = DB::table('satisfaction_answers')
                        ->select('satisfaction_answers.id','satisfaction_answers.case_id','satisfaction_answers.owner','satisfaction_answers.views','accounts.cuskey','accounts.name','satisfaction_answers.created_at')
                        ->leftjoin('accounts','satisfaction_answers.account_id','=','accounts.id')
                        ->where('satisfaction_answers.department_id',Auth::user()->department_id)
                        ->get();

    	return view('ht.FormDetails.satisfactionSurvey.index',compact('organization','caseCount','satisfaction'));
    }

    public function show(Organization $organization,$id)
    {
        $id = base64_decode($id);

        $res = SatisfactionAnswer::where('id',$id)->get();

        //更新狀態-是否查看
        $view = SatisfactionAnswer::find($id);
        $view->views = 'Y';
        $view->save();

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
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

        return view('ht.FormDetails.satisfactionSurvey.show',compact('organization','res','caseCount'));
    }

    public function satisfactionSearch(Organization $organization,Request $request)
    { 
        $end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

        $data = DB::table('satisfaction_answers')
                        ->select('satisfaction_answers.id','satisfaction_answers.case_id','satisfaction_answers.owner','accounts.cuskey','accounts.name','satisfaction_answers.created_at')
                        ->leftjoin('accounts','satisfaction_answers.account_id','=','accounts.id')
                        ->where('satisfaction_answers.department_id',Auth::user()->department_id)
                        ->whereBetween('satisfaction_answers.created_at',[$request->start,$end])
                        ->get();

        return $data;
    }
}
