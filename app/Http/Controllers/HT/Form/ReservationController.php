<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class ReservationController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.Form.reservation.index',compact('organization'));
    }
}
