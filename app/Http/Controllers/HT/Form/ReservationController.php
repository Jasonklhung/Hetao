<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Reservation;

use Auth;

class ReservationController extends Controller
{
    public function index(Organization $organization,Request $request)
    {
        $reservation = Reservation::where('organization_id',$organization->id)->get();

        $count = Reservation::where('organization_id',$organization->id)->count();

        $job = Auth::user()->job;
        $dept = Organization::where('id',$organization->id)->get();
        
        if($job == '員工'){
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

    	return view('ht.Form.reservation.index',compact('organization','reservation','count','caseCount'));
    }

    public function store(Organization $organization,Request $request)
    {

        $reservation = Reservation::where('organization_id',$organization->id)->get();

    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

        if($reservation->isNotEmpty()){

            $reservation = Reservation::where('organization_id',$organization->id)->delete();

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->organization_id = $organization->id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }
        else{

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->organization_id = $organization->id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }

    	return response()->json(['success'=>['ok']]);
    }
}
