<?php

namespace App\Http\Controllers\HT\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;

class ContactController extends Controller
{
    public function index(Organization $organization)
    {
    	return view('ht.Form.contact.index',compact('organization'));
    }
}
