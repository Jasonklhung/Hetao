<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssistantController extends Controller
{
    public function index()
    {
    	return view('ht.StrokeManage.assistant.index');
    }
}
