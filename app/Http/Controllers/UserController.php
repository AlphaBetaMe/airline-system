<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $airports = Airport::all();
        return view('user.index', compact('flights', 'airports'));
    }

    public function flightList()
    {
        return view('user.flight-list');
    }
}
