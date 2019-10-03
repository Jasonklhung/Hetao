<?php

namespace App\Http\Controllers\HT\StrokeManage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use GuzzleHttp\Client;

class StaffController extends Controller
{
    public function index(Organization $organization)
    {
    	// $client = new \GuzzleHttp\Client();
    	// $response = $client->post('http://60.251.216.90:8855/api_/get-all-case', [
    	// 	'headers' => ['Content-Type' => 'application/json'],
    	// 	'body' => json_encode([
    	// 		'token' => $request->token,
    	// 		'DEPT' => $request->DEPT
    	// 	])
    	// ]);

    	// $response = $response->getBody()->getContents();

    	return view('ht.StrokeManage.staff.index',compact('organization'));
    }
}
