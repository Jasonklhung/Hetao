<?php

namespace App\Http\Controllers\HT\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use App\Permission;
use App\Department;
use Auth;

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

    public function getCompany(Organization $organization,Request $request)
    {
    	$organization_id = $request->value;

    	$dept = Organization::find($organization_id)->departments;

    	return $dept;
    }

    public function store(Organization $organization,Permission $permission,Request $request)
    {
    	$user = new User;
    	$user->organization_id = $request->company;
    	$user->department_id = $request->company;
    	$user->name = $request->name;
    	$user->ID_number = $request->ID_number;
    	$user->mobile = $request->mobile;
    	$user->emp_id = $request->emp_id;
    	$user->password = bcrypt($request->emp_id);
    	$user->job = $request->job;
    	$user->save();

    	$permission = new Permission;
    	$permission->user_id = $user->id;
    	(isset($request->assistant))? $permission->assistant = 'Y' : $permission->assistant = 'N';
    	(isset($request->supervisor))? $permission->supervisor = 'Y' : $permission->supervisor = 'N';
    	(isset($request->staff))? $permission->staff = 'Y' : $permission->staff = 'N';
    	(isset($request->reservation))? $permission->reservation = 'Y' : $permission->reservation = 'N';
    	(isset($request->satisfaction))? $permission->satisfaction = 'Y' : $permission->satisfaction = 'N';
    	(isset($request->contact))? $permission->contact = 'Y' : $permission->contact = 'N';
    	(isset($request->timeset))? $permission->timeset = 'Y' : $permission->timeset = 'N';
    	(isset($request->permission))? $permission->permission = 'Y' : $permission->permission = 'N';
    	$permission->save();

    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','新增成功');
    }

    public function edit(Organization $organization,$id)
    {
    	$user = User::find($id);
    	$permission = User::find($id)->permission;
    	$company = Organization::all();
    	$dept = Organization::find($user->organization_id)->departments;

    	return view('ht.Permission.edit',compact('organization','user','permission','company','dept'));
    }

    public function update(Organization $organization,Request $request)
    {

    	$user = User::find($request->id);
        $user->organization_id = $request->company;
    	$user->department_id = $request->company;
    	$user->name = $request->name;
    	$user->ID_number = $request->ID_number;
    	$user->mobile = $request->mobile;
    	$user->emp_id = $request->emp_id;
    	$user->password = bcrypt($request->emp_id);
    	$user->job = $request->job;
    	$user->save();

    	$permission = User::find($request->id)->permission;
    	(isset($request->assistant))? $permission->assistant = 'Y' : $permission->assistant = 'N';
    	(isset($request->supervisor))? $permission->supervisor = 'Y' : $permission->supervisor = 'N';
    	(isset($request->staff))? $permission->staff = 'Y' : $permission->staff = 'N';
    	(isset($request->reservation))? $permission->reservation = 'Y' : $permission->reservation = 'N';
    	(isset($request->satisfaction))? $permission->satisfaction = 'Y' : $permission->satisfaction = 'N';
    	(isset($request->contact))? $permission->contact = 'Y' : $permission->contact = 'N';
    	(isset($request->timeset))? $permission->timeset = 'Y' : $permission->timeset = 'N';
    	(isset($request->permission))? $permission->permission = 'Y' : $permission->permission = 'N';
    	$permission->save();

        //line api
        if($request->job == '員工'){

            $userId = Auth::user()->token;
            $richmenuId = 'richmenu-378a6d5027112cad45cbb8c9964d42e4' ;
            $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
                'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            ]);
        }
        elseif($request->job == '助理'){

            $userId = Auth::user()->token;
            $richmenuId = 'richmenu-0b9890f50d5cd767db86c87dec17ebdd' ;
            $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
                'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            ]);
        }
        elseif($request->job == '主管'){

            $userId = Auth::user()->token;
            $richmenuId = 'richmenu-0b9890f50d5cd767db86c87dec17ebdd' ;
            $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
                'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            ]);
        }


    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','修改成功');
    }

    public function getUserInfo(Organization $organization,Request $request)
    {
    	$user_id = $request->user_id;

    	$user = User::find($user_id);
    	$company_user = Organization::find($user->organization_id);
    	$dept_user = Department::find($user->department_id);

    	return [$user,$company_user,$dept_user];
    }

    public function destroy(Request $request,Organization $organization,User $user)
    {
    	$user = User::find($request->id);

    	$user->delete();

        $userId = Auth::user()->token;
        $richmenuId = 'richmenu-183e75de1b54741099d3b3c6952c21b0' ;
        $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
            'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://linebotclient.azurewebsites.net/line/1608443818/liff/api/updateSet.php', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'userId' => Auth::user()->token,
            ])
        ]);

        $response = $response->getBody()->getContents();

    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','刪除成功');
    }
}
