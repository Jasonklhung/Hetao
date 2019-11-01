<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
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
        $dept = Department::where('name',$request->DEPT)->get();

    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[$key] = $value;
        }

    	$id = Account::where('token',$request->token)->get();

    	$res = new ReservationAnswer;
        $res->department_id = $dept[0]['id'];
    	$res->account_id = $id[0]['id'];
    	$res->form = json_encode($form);
    	$res->save();   

    	return 'ok';
    }
}
