<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Contact;

use Auth;
use DB;

class ContactController extends Controller
{
    public function index(Organization $organization)
    {
        $contact = Contact::all();

        $count = Contact::all()->count();

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

    	return view('ht.Form.contact.index',compact('organization','contact','count','caseCount'));
    }

    public function store(Organization $organization,Request $request)
    {

        $contact = Contact::all();

    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

        if($contact->isNotEmpty()){

            DB::table('contacts')->truncate();


            foreach ($form as $k => $v) {

                $res = new Contact;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }

        }
        else{

            foreach ($form as $k => $v) {
                $res = new Contact;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }

    	return response()->json(['success'=>['ok']]);
    }
}
