<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SatisfactionController extends Controller
{
    public function index()
    {
    	return view('ht.Form.satisfaction.index');
    }
}
