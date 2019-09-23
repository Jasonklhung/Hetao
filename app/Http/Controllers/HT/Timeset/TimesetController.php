<?php

namespace App\Http\Controllers\HT\Timeset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimesetController extends Controller
{
    public function index()
    {
    	return view('ht.Timeset.index');
    }
}
