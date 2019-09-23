<?php

namespace App\Http\Controllers\HT\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
    	return view('ht.Permission.index');
    }
}
