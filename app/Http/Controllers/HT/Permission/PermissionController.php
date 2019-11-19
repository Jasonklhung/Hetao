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

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $countArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;

                foreach ($array as $k => $v) {
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

    	return view('ht.Permission.index',compact('organization','users','caseCount'));
    }

    public function create(Organization $organization)
    {
    	$company = Organization::all();

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $countArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;

                foreach ($array as $k => $v) {
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

    	return view('ht.Permission.create',compact('organization','company','caseCount'));
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
        (isset($request->contactUs))? $permission->contactUs = 'Y' : $permission->contactUs = 'N';
        (isset($request->satisfactionSurvey))? $permission->satisfactionSurvey = 'Y' : $permission->satisfactionSurvey = 'N';
    	$permission->save();

    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','新增成功');
    }

    public function edit(Organization $organization,$id)
    {
    	$user = User::find($id);
    	$permission = User::find($id)->permission;
    	$company = Organization::all();
    	$dept = Organization::find($user->organization_id)->departments;

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'token' => Auth::user()->token,//Auth::user()->token,
                'DEPT' => Auth::user()->department->name//Auth::user()->department->name
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

        $countArray = array();

        foreach ($data as $key => $value) {
            if($key == 'data'){
                $array = $value;

                foreach ($array as $k => $v) {
                    if($v->owner == null || $v->owner == ''){
                        array_push($countArray,$v);
                    }
                }
            }
        }

        $caseCount = count($countArray);

    	return view('ht.Permission.edit',compact('organization','user','permission','company','dept','caseCount'));
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
        (isset($request->contactUs))? $permission->contactUs = 'Y' : $permission->contactUs = 'N';
        (isset($request->satisfactionSurvey))? $permission->satisfactionSurvey = 'Y' : $permission->satisfactionSurvey = 'N';
    	$permission->save();

        //line api
        if($request->job == '員工'){

            $userId = $user['token'];
            $richmenuId = 'richmenu-378a6d5027112cad45cbb8c9964d42e4' ;
            $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
                'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            ]);
        }
        elseif($request->job == '助理'){

            $userId = $user['token'];
            $richmenuId = 'richmenu-0b9890f50d5cd767db86c87dec17ebdd' ;
            $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
                'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            ]);
        }
        elseif($request->job == '主管'){

            $userId = $user['token'];
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

        $userId = $user['token'];

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
                'userId' => $userId,
            ])
        ]);

        $response = $response->getBody()->getContents();

    	return redirect()->route('ht.Permission.index',compact('organization'))->with('success','刪除成功');
    }
}
