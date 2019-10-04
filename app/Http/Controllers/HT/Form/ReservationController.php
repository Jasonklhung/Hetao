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

    	return view('ht.Form.reservation.index',compact('organization'));
    }

    public function store(Organization $organization,Request $request)
    {
    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

    	foreach ($form as $k => $v) {
    		$res = new Reservation;
    		$res->name = $k;
    		$res->form = json_encode($v);
    		$res->save();	
    	}

    	return response()->json(['success'=>['ok']]);
    }

    public function getData(Organization $organization,Request $request)
    {
    	$data = Reservation::all();

    	return $data;
    }
}
