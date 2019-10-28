<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Satisfaction;

class SatisfactionController extends Controller
{
    public function index()
    {
        $data = Satisfaction::all();

        return $data;
    }
}
