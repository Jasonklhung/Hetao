<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class SupervisorController extends Controller
{
    public function index(Organization $organization)
    {
    	$action = '';

    	return view('ht.StrokeManage.supervisor.index',compact('organization','action'));
    }
}
