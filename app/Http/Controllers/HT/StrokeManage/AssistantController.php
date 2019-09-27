<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class AssistantController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.StrokeManage.assistant.index',compact('organization'));
    }
}
