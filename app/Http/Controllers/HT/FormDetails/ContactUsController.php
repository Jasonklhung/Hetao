<?php

namespace App\Http\Controllers\HT\FormDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Organization;
use App\ContactAnswer;

class ContactUsController extends Controller
{
    public function index(Organization $organization)
    {
    	$job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工' || $job == '業務'){
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

        $contact = ContactAnswer::all();

    	return view('ht.FormDetails.ContactUs.index',compact('organization','caseCount','contact'));
    }

    public function show(Organization $organization,$id)
    {
        $id = base64_decode($id);

        $res = ContactAnswer::where('id',$id)->get();

        //更新狀態-是否查看
        $view = ContactAnswer::find($id);
        $view->views = 'Y';
        $view->save();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();

        if($job == '員工' || $job == '業務'){
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

        return view('ht.FormDetails.ContactUs.show',compact('organization','res','caseCount'));
    }

    public function contactSearch(Organization $organization,Request $request)
    { 
    	$end = date("Y-m-d",strtotime("+1 day",strtotime($request->end)));

    	$data = ContactAnswer::whereBetween('created_at',[$request->start,$end])->get();

    	return $data;
    }
}
