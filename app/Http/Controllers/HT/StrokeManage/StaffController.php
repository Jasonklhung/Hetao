<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class StaffController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.StrokeManage.staff.index',compact('organization'));
    }
}
