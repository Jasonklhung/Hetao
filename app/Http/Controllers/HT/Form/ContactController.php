<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Contact;

use Auth;

class ContactController extends Controller
{
    public function index(Organization $organization)
    {
        $contact = Contact::where('organization_id',Auth::user()->organization_id)->get();

        $count = Contact::where('organization_id',Auth::user()->organization_id)->count();

    	return view('ht.Form.contact.index',compact('organization','contact','count'));
    }

    public function store(Organization $organization,Request $request)
    {

        $contact = Contact::where('organization_id',Auth::user()->organization_id)->get();

    	$form = array();

    	foreach ($request->name as $name => $n) {
    		foreach ($request->form as $key => $value) {
    			if($name == $key){
    				$form[$n] = $value;
    			}
    		}
    	}

        if($contact->isNotEmpty()){

            $contact = Contact::where('organization_id',Auth::user()->organization_id)->delete();

            foreach ($form as $k => $v) {

                $res = new Contact;
                $res->organization_id = Auth::user()->organization_id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }

        }
        else{

            foreach ($form as $k => $v) {
                $res = new Contact;
                $res->organization_id = Auth::user()->organization_id;
                $res->name = $k;
                $res->form = json_encode($v);
                $res->save();   
            }
        }

    	return response()->json(['success'=>['ok']]);
    }
}
