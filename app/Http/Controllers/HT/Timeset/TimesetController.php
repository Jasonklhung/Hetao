<?php

namespace App\Http\Controllers\HT\Timeset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class TimesetController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.Timeset.index',compact('organization'));
    }
}
