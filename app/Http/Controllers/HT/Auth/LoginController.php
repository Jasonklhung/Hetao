<?php

namespace App\Http\Controllers\HT\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use GuzzleHttp\Client;
use Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function show()
    {

        $random=substr(md5(uniqid(rand(), true)),0,14);

        $UUID = 'HT'.$random;

        $client = new Client;
        $response = $client->request('GET','https://bot168.azurewebsites.net/api/qr/?https://line.me/R/oaMessage/@320hyrul/?'.$UUID.'')
        ->getBody()->getContents();

        $result = json_decode($response);

        $qrcode = $result->image;

        return view('auth.login',compact('qrcode','UUID'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('ht.Auth.show');
    }

    public function getUUID(User $user,Request $request)
    {
    	$user = User::where('UUID', $request->UUID)->first();

    	if(isset($user)){

    		if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

    			$users = User::where('id', $user['id'])->update(['UUID' => null]);

    			return response()->json([
    				'redirect'=>route('ht.Overview.index',['organization'=>$user['organization_id']]),
    			],	200);
    		}
    	}
    	else{
    		return 'failed';
    	}
    }

    public function assignCase()
    {
        return view('auth.assignCase');
    }

    public function getAssignCase(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if(isset($user)){

            if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

                if($user['job'] == '助理'){

                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.assistant.index2',['organization'=>$user['organization_id']]),
                    ],  200);
                }
                elseif($user['job'] == '主管'){
                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.supervisor.index',['organization'=>$user['organization_id']]),
                    ],  200);
                } 
            }
        }
        else{
            return 'failed';
        }
    }

    public function report()
    {
        return view('auth.report');
    }

    public function getReport(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if(isset($user)){

            if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

                if($user['job'] == '助理'){

                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.assistant.index3',['organization'=>$user['organization_id']]),
                    ],  200);
                }
                elseif($user['job'] == '主管'){

                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.supervisor.index3',['organization'=>$user['organization_id']]),
                    ],  200);
                } 
                elseif($user['job'] == '員工'){
                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.staff.index',['organization'=>$user['organization_id']]),
                    ],  200);
                } 
            }
        }
        else{
            return 'failed';
        }
    }

    public function overview()
    {
        return view('auth.overview');
    }

    public function getOverview(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if(isset($user)){

            if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

                return response()->json([
                    'redirect'=>route('ht.Overview.index',['organization'=>$user['organization_id']]),
                ],  200);
            }
        }
        else{
            return 'failed';
        }
    }
}
