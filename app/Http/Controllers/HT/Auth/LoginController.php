<?php

namespace App\Http\Controllers\HT\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function show()
    {

    	$client = new Client;
    	$response = $client->request('GET','https://bot168.azurewebsites.net/api/qr/?https://line.me/R/oaMessage/@320hyrul/')
    	->getBody()->getContents();

    	$result = json_decode($response);

    	$qrcode = $result->image;

    	return view('auth.login',compact('qrcode'));
    }
}
