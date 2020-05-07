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

    	$users = User::select('users.*','organizations.name as company','organizations.area')
    			->Leftjoin('organizations','users.organization_id','=','organizations.id')
    			->where('organization_id',$organization->id)->get();

        $job = Auth::user()->job;
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }else{
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
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

        //列出所有營站
        $org = Organization::where('id','!=','1')->get();

    	return view('ht.Permission.index',compact('organization','users','caseCount','org'));
    }

    public function create(Organization $organization)
    {
        $companyArray = array();
        $company_res = array();

    	$company = Organization::where('name','!=','愛酷智能科技')->distinct()->get('area');

        foreach ($company as $key => $value) {
            array_push($companyArray, $value['area']);
        }

        $company = Organization::where('name','!=','愛酷智能科技')->get();

        foreach ($companyArray as $key => $value) {
            foreach ($company as $k => $v) {
                if($value == $v['area']){
                    $company_res[$value][] = array('name'=>$v['name'].$v['company_name'],'id'=>$v['id']);
                }
            }
        }

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

    	return view('ht.Permission.create',compact('organization','company_res','caseCount'));
    }

    public function getCompany(Organization $organization,Request $request)
    {
    	$organization_id = $request->value;

    	$dept = Organization::find($organization_id)->departments;

    	return $dept;
    }

    public function store(Organization $organization,Permission $permission,Request $request)
    {
        $organizations_name = array();
        foreach ($request->company as $key => $value) {
            $rs = Organization::find($value);
            array_push($organizations_name, $rs['name'].$rs['company_name']);
        }

    	$user = new User;
    	$user->organization_id = $request->company[0];
    	$user->department_id = $request->company[0];
        (count($request->company) > 1)? $user->organizations = implode(',', $request->company) : $user->organizations = $request->company[0]; 
        (count($request->company) > 1)? $user->organizations_name = implode(',', $organizations_name) : $user->organizations_name = $organizations_name[0]; 
    	$user->name = $request->name;
    	$user->ID_number = $request->ID_number;
    	$user->mobile = $request->mobile;
    	$user->emp_id = $request->emp_id;
    	$user->password = bcrypt($request->emp_id);
    	$user->job = $request->job;
    	$user->save();

    	$permission = new Permission;
    	$permission->user_id = $user->id;
        (isset($request->overview))? $permission->overview = 'Y' : $permission->overview = 'N';
        (isset($request->notice))? $permission->notice = 'Y' : $permission->notice = 'N';
    	(isset($request->assistant))? $permission->assistant = 'Y' : $permission->assistant = 'N';
    	(isset($request->supervisor))? $permission->supervisor = 'Y' : $permission->supervisor = 'N';
    	(isset($request->staff))? $permission->staff = 'Y' : $permission->staff = 'N';
        (isset($request->cycle_self))? $permission->cycle_self = 'Y' : $permission->cycle_self = 'N';
        (isset($request->cycle_all))? $permission->cycle_all = 'Y' : $permission->cycle_all = 'N';
        (isset($request->cycle_now))? $permission->cycle_now = 'Y' : $permission->cycle_now = 'N';
        (isset($request->material))? $permission->material = 'Y' : $permission->material = 'N';
        (isset($request->material_case))? $permission->material_case = 'Y' : $permission->material_case = 'N';
        (isset($request->material_stock))? $permission->material_stock = 'Y' : $permission->material_stock = 'N';
        (isset($request->custom_info))? $permission->custom_info = 'Y' : $permission->custom_info = 'N';
        (isset($request->business_self))? $permission->business_self = 'Y' : $permission->business_self = 'N';
        (isset($request->business_all))? $permission->business_all = 'Y' : $permission->business_all = 'N';
        (isset($request->performance_self))? $permission->performance_self = 'Y' : $permission->performance_self = 'N';
        (isset($request->performance_all))? $permission->performance_all = 'Y' : $permission->performance_all = 'N';
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
        if($user->organizations == null){
            $user_organization = [$user->organization_id];
        }
        else{
            $user_organization = explode(',', $user->organizations);
        }
        
    	$permission = User::find($id)->permission;

    	$companyArray = array();
        $company_res = array();

        $company = Organization::where('name','!=','愛酷智能科技')->distinct()->get('area');

        foreach ($company as $key => $value) {
            array_push($companyArray, $value['area']);
        }

        $company = Organization::where('name','!=','愛酷智能科技')->get();

        foreach ($companyArray as $key => $value) {
            foreach ($company as $k => $v) {
                if($v['area'] == $value){
                    $company_res[$value][] = array('name'=>$v['name'].$v['company_name'],'id'=>$v['id']);
                }
            }
        }

    	$dept = Organization::find($user->organization_id)->departments;

        $job = Auth::user()->job;
        if($job == '員工'){
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://60.251.216.90:8855/api_/schedule', [
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
                        if($v->status == null || $v->status == '' || $v->status == 'F'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }else{
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
                        if($v->owner == null || $v->owner == '' || $v->status == 'R'){
                            array_push($countArray,$v);
                        }
                    }
                }
            }

            $caseCount = count($countArray);
        }

    	return view('ht.Permission.edit',compact('organization','user','permission','company_res','dept','caseCount','user_organization'));
    }

    public function update(Organization $organization,Request $request)
    {
        $organizations_name = array();

        foreach ($request->company as $key => $value) {
            $rs = Organization::find($value);
            array_push($organizations_name, $rs['name'].$rs['company_name']);
        }

    	$user = User::find($request->id);
        $user->organization_id = $request->company[0];
        $user->department_id = $request->company[0];
        (count($request->company) > 1)? $user->organizations = implode(',', $request->company) : $user->organizations = $request->company[0];
        (count($request->company) > 1)? $user->organizations_name = implode(',', $organizations_name) : $user->organizations_name = $organizations_name[0]; 
        $user->name = $request->name;
        $user->ID_number = $request->ID_number;
        $user->mobile = $request->mobile;
        $user->emp_id = $request->emp_id;
        $user->password = bcrypt($request->emp_id);
        $user->job = $request->job;
    	$user->save();

    	$permission = User::find($request->id)->permission;
    	(isset($request->overview))? $permission->overview = 'Y' : $permission->overview = 'N';
        (isset($request->notice))? $permission->notice = 'Y' : $permission->notice = 'N';
        (isset($request->assistant))? $permission->assistant = 'Y' : $permission->assistant = 'N';
        (isset($request->supervisor))? $permission->supervisor = 'Y' : $permission->supervisor = 'N';
        (isset($request->staff))? $permission->staff = 'Y' : $permission->staff = 'N';
        (isset($request->cycle_self))? $permission->cycle_self = 'Y' : $permission->cycle_self = 'N';
        (isset($request->cycle_all))? $permission->cycle_all = 'Y' : $permission->cycle_all = 'N';
        (isset($request->cycle_now))? $permission->cycle_now = 'Y' : $permission->cycle_now = 'N';
        (isset($request->material))? $permission->material = 'Y' : $permission->material = 'N';
        (isset($request->material_case))? $permission->material_case = 'Y' : $permission->material_case = 'N';
        (isset($request->material_stock))? $permission->material_stock = 'Y' : $permission->material_stock = 'N';
        (isset($request->custom_info))? $permission->custom_info = 'Y' : $permission->custom_info = 'N';
        (isset($request->business_self))? $permission->business_self = 'Y' : $permission->business_self = 'N';
        (isset($request->business_all))? $permission->business_all = 'Y' : $permission->business_all = 'N';
        (isset($request->performance_self))? $permission->performance_self = 'Y' : $permission->performance_self = 'N';
        (isset($request->performance_all))? $permission->performance_all = 'Y' : $permission->performance_all = 'N';
        (isset($request->reservation))? $permission->reservation = 'Y' : $permission->reservation = 'N';
        (isset($request->satisfaction))? $permission->satisfaction = 'Y' : $permission->satisfaction = 'N';
        (isset($request->contact))? $permission->contact = 'Y' : $permission->contact = 'N';
        (isset($request->timeset))? $permission->timeset = 'Y' : $permission->timeset = 'N';
        (isset($request->permission))? $permission->permission = 'Y' : $permission->permission = 'N';
        (isset($request->contactUs))? $permission->contactUs = 'Y' : $permission->contactUs = 'N';
        (isset($request->satisfactionSurvey))? $permission->satisfactionSurvey = 'Y' : $permission->satisfactionSurvey = 'N';
    	$permission->save();

        //line api
        $Hastoken = User::find($request->id);
        if($Hastoken['token'] == '' || $Hastoken['token'] == 'null'){
            return redirect()->route('ht.Permission.index',compact('organization'))->with('success','修改成功');
        }
        else{
            if($request->job == '員工'){

                $userId = $user['token'];
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://accunixwh.azurewebsites.net/api/LINEBot/5dfafa8e/authenticate/26', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'user_token' => $userId,
                        'role'=>77,
                    ])
                ]);
            }
            elseif($request->job == '助理'){

                $userId = $user['token'];
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://accunixwh.azurewebsites.net/api/LINEBot/5dfafa8e/authenticate/26', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'user_token' => $userId,
                        'role'=>76,
                    ])
                ]);
            }
            elseif($request->job == '主管'){

                $userId = $user['token'];
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://accunixwh.azurewebsites.net/api/LINEBot/5dfafa8e/authenticate/26', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'user_token' => $userId,
                        'role'=>76,
                    ])
                ]);
            }


            return redirect()->route('ht.Permission.index',compact('organization'))->with('success','修改成功');
        }
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

        if($userId == '' || $userId == 'null'){
            return redirect()->route('ht.Permission.index',compact('organization'))->with('success','刪除成功');
        }
        else{
            // $richmenuId = 'richmenu-183e75de1b54741099d3b3c6952c21b0' ;
            // $channel = 'kigQJsG6rQh2yJFhqcpQY0WMc/xSsUFLFwuoTs+N4zo0Xx7BmN+qxxXZ0m2IXSb31++yliJDSvyIeLYci3ZrOIHus58KTjVQrLydr2+fk6q+2TmnPThJUzcDtoaXy15KdbHuqdXkhhKM/oJ/33qLiAdB04t89/1O/w1cDnyilFU=' ;

            // $client = new \GuzzleHttp\Client();
            // $response = $client->post('https://api.line.me/v2/bot/user/'.$userId.'/richmenu/'.$richmenuId, [
            //     'headers' => ['Content-Length' => '0','Authorization' => 'Bearer '.$channel],
            // ]);

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://accunixwh.azurewebsites.net/api/LINEBot/5dfafa8e/authenticate/26', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'user_token' => $userId,
                    'role'=>79,
                ])
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

    public function createOrg(Organization $organization,Request $request)
    {
        $org = new Organization;
        $org->name = $request->name;
        $org->phone = $request->phone;
        $org->company_name = $request->company_name;
        $org->company_name_out = $request->company_name_out;
        $org->area = $request->area;
        $org->save();

        return redirect()->route('ht.Permission.index',compact('organization'))->with('success','營站新增成功');
    }

    public function searchUser(Organization $organization,Request $request)
    {
        $user = User::select('users.*','organizations.name as company','organizations.area')
                ->Leftjoin('organizations','users.organization_id','=','organizations.id')
                ->where('organization_id',$request->id)->get();

        return $user;
    }
}
