<?php

namespace App\Http\Controllers\HT\Overview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class OverviewController extends Controller
{
    public function index()
    {
    	return view('ht.Overview.index');
    }

    public function getData(Request $request)
    {

    	$client = new \GuzzleHttp\Client();
    	$response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
    		'headers' => ['Content-Type' => 'application/json'],
    		'body' => json_encode([
    			'token' => $request->token,
    			'DEPT' => $request->DEPT
    		])
    	]);

    	$response = $response->getBody()->getContents();

    	return $response;
    }
}
