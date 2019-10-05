<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $data = Reservation::select('form')->get();

        return $data;
    }
}
