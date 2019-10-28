<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Reservation;

class ReservationController extends Controller
{
    public function index(Organization $organization,Request $request)
    {
        $reservation = Reservation::all();

        $count = Reservation::all()->count();

    	return view('ht.Form.reservation.index',compact('organization','reservation','count'));
    }

    public function store(Organization $organization,Request $request)
    {
        $reservation = Reservation::all();

    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

        if($reservation->isNotEmpty()){
            Reservation::truncate();

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }
        else{

            foreach ($form as $k => $v) {
                $res = new Reservation;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }

    	return response()->json(['success'=>['ok']]);
    }
}
