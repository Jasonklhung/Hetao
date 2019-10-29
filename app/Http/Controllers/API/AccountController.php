<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;

class AccountController extends Controller
{
    public function store(Request $request)
    {
    	dd($request->all());
    }
}
