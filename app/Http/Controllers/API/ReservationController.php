<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\ReservationAnswer;

class ReservationController extends Controller
{
    public function index()
    {
        $data = Reservation::all();

        return $data;
    }

    public function store(Request $request)
    {
    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[$key] = $value;
        }

    	$id = Account::where('token',$request->token)->get();

    	$res = new ReservationAnswer;
    	$res->account_id = $id[0]['id'];
    	$res->form = json_encode($form);
    	$res->save();   

    	return 'ok';
    }
}
