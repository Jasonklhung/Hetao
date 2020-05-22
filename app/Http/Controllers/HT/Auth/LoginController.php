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
        $response = $client->request('GET','https://bot168.azurewebsites.net/api/qr/?https://line.me/R/oaMessage/@znm5920w/?'.$UUID.'')
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

                $client = new \GuzzleHttp\Client();
                $data =  json_encode(array('user_token' => $user['token'],'messages' => [array('type'=>'text','text'=> '登入成功')] ));
                $response = $client->post('https://accunixwh.azurewebsites.net/api/LINEBot/5dfafa8e/sendMessages', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => $data
                ]);

                $response = $response->getBody()->getContents();

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

                if(Auth::user()->permission->supervisor == 'Y'){
                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.supervisor.index3',['organization'=>$user['organization_id']]),
                    ],  200);
                }
                else{
                    return response()->json([
                        'redirect'=>route('ht.Overview.index',['organization'=>$user['organization_id']]),
                    ],  200);
                }

                // if($user['job'] == '助理'){

                //     return response()->json([
                //         'redirect'=>route('ht.StrokeManage.assistant.index2',['organization'=>$user['organization_id']]),
                //     ],  200);
                // }
                // elseif($user['job'] == '主管'){
                //     return response()->json([
                //         'redirect'=>route('ht.StrokeManage.supervisor.index',['organization'=>$user['organization_id']]),
                //     ],  200);
                // } 
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

                if(Auth::user()->permission->assistant == 'Y'){
                    return response()->json([
                        'redirect'=>route('ht.StrokeManage.staff.index',['organization'=>$user['organization_id']]),
                    ],  200);
                }
                else{
                    return response()->json([
                        'redirect'=>route('ht.Overview.index',['organization'=>$user['organization_id']]),
                    ],  200);
                }

                // if($user['job'] == '助理'){

                //     return response()->json([
                //         'redirect'=>route('ht.StrokeManage.assistant.index3',['organization'=>$user['organization_id']]),
                //     ],  200);
                // }
                // elseif($user['job'] == '主管'){

                //     return response()->json([
                //         'redirect'=>route('ht.StrokeManage.supervisor.index3',['organization'=>$user['organization_id']]),
                //     ],  200);
                // } 
                // elseif($user['job'] == '員工'){
                //     return response()->json([
                //         'redirect'=>route('ht.StrokeManage.staff.index',['organization'=>$user['organization_id']]),
                //     ],  200);
                // } 
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

    public function noticePage()
    {
        return view('auth.noticePage');
    }

    public function getNoticePage(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $id = $request->id;

        if(isset($user)){

            if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

                return response()->json([
                    'redirect'=>route('ht.Overview.notice.index',['organization'=>$user['organization_id'],'id'=>$id]),
                ],  200);
            }
        }
        else{
            return 'failed';
        }
    }

    public function redirectRoute(Request $request)
    {
        // dd($request->all());

        // return view('auth.redirectRoute');

        $user = User::where('token', $request->user_token)->first();
        $route = $request->route;

        if(isset($user)){

            if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

                $organization = $user['organization_id'];
                dd($organization);

                if($route == 'overview'){
                    return redirect()->route('ht.Overview.index',compact('organization'));
                }
                elseif($route == 'notice'){
                    return redirect()->route('ht.Overview.notice.index',compact('organization'));
                }
                elseif($route == 'customer'){
                    return redirect()->route('ht.Customer.index',compact('organization'));
                }
                elseif($route == 'visit'){
                    return redirect()->route('ht.Business.self.index',compact('organization'));
                }
                elseif($route == 'track'){
                    return redirect()->route('ht.Business.self.index2',compact('organization'));
                }
                elseif($route == 'caseReport'){
                    return redirect()->route('ht.StrokeManage.assistant.index',compact('organization'));
                }
            }
        }
        else{
            return 'failed';
        }
    }
}
