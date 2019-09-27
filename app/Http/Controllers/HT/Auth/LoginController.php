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

    public function getUUID(User $user,Request $request)
    {
    	$user = User::where('UUID', $request->UUID)->first();

    	if(isset($user)){

    		if (Auth::attempt(array('mobile' => $user['mobile'], 'password' => $user['emp_id']))){

    			$user = User::where('id', $user['id'])->update(['UUID' => null]);

    			return redirect()->route('ht.Overview.index');
    		}
    	}
    	else{
    		return 'failed';
    	}
    }
}
