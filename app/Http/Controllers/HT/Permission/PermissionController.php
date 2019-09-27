<?php

namespace App\Http\Controllers\HT\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class PermissionController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.Permission.index',compact('organization'));
    }
}
