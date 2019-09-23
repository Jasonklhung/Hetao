<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupervisorController extends Controller
{
    public function index()
    {
    	return view('ht.StrokeManage.supervisor.index');
    }
}
