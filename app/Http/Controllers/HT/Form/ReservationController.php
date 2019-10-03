<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class ReservationController extends Controller
{
    public function index(Organization $organization,Request $request)
    {

    	return view('ht.Form.reservation.index',compact('organization'));
    }

    public function store(Organization $organization,Request $request)
    {
    	dd($request->all());
    }
}
