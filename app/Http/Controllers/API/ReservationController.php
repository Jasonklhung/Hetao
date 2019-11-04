<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Reservation;
use App\ReservationAnswer;

class ReservationController extends Controller
{
    public function index(Request $request)
    {

        $data = Reservation::where('organization_id',$request->organization_id)->get();

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
        $res->department_id = $request->DEPT;
    	$res->account_id = $id[0]['id'];
    	$res->form = json_encode($form);
    	$res->save();   

    	return 'ok';
    }
}
