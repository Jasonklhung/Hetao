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

    	return view('ht.Form.contact.index',compact('organization','contact','count'));
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
