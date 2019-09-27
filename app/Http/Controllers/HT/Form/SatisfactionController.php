<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class SatisfactionController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.Form.satisfaction.index',compact('organization'));
    }
}
