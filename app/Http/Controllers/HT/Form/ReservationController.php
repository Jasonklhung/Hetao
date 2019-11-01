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
        $reservation = Reservation::where('organization_id',Auth::user()->organization_id)->get();

        $count = Reservation::where('organization_id',Auth::user()->organization_id)->count();

    	return view('ht.Form.reservation.index',compact('organization','reservation','count'));
    }

    public function store(Organization $organization,Request $request)
    {

        $reservation = Reservation::where('organization_id',Auth::user()->organization_id)->get();

    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

        if($reservation->isNotEmpty()){

            $reservation = Reservation::where('organization_id',Auth::user()->organization_id)->delete();

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->organization_id = Auth::user()->organization_id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }
        else{

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->organization_id = Auth::user()->organization_id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }

    	return response()->json(['success'=>['ok']]);
    }
}
