<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;

class AccountController extends Controller
{
    public function store(Request $request)
    {
    	$account = new Account;
    	$account->token = $request->userId;
    	$account->cuskey = $request->CUSTKEY;
    	$account->dept = $request->DEPT;
    	$account->name = $request->name;
    	$account->card_number = $request->CARDNO;
    	$account->save();

    	return response()->json(['success'=>['ok']]);
    }
}
