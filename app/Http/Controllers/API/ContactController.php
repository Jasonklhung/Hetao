<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\ContactAnswer;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::all();

        return $data;
    }

    public function store(Request $request)
    {
    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[$key] = $value;
        }

    	$res = new ContactAnswer;
    	$res->form = json_encode($form);
    	$res->save();   

    	return 'ok';
    }
}
