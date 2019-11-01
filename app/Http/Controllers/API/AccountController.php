<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Organization;
use App\Department;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        $depart = Department::where('name',$request->DEPT)->get();

    	$account = new Account;
        $account->organization_id = $depart[0]['organization_id'];
        $account->department_id = $depart[0]['id'];
    	$account->token = $request->userId;
    	$account->cuskey = $request->CUSTKEY;
    	$account->dept = $request->DEPT;
    	$account->name = $request->name;
    	$account->card_number = $request->CARDNO;
    	$account->save();

    	return response()->json(['success'=>['ok']]);
    }
}
