<?php

namespace App\Http\Controllers\HT\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\User;

class PermissionController extends Controller
{
    public function index(Organization $organization,User $user)
    {

    	$users = User::select('users.*','organizations.name as company')
    			->Leftjoin('organizations','users.organization_id','=','organizations.id')
    			->where('organization_id',$organization->id)->get();

    	return view('ht.Permission.index',compact('organization','users'));
    }

    public function create(Organization $organization)
    {
    	$company = Organization::all();

    	return view('ht.Permission.create',compact('organization','company'));
    }

    public function edit(Organization $organization)
    {
    	return view('ht.Permission.edit',compact('organization'));
    }

    public function destroy(Request $request,Organization $organization,User $user)
    {
    	$user = User::find($request->id);

    	$user->delete();

    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','刪除成功');
    }
}
