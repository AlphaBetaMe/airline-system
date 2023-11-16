<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $airports = Airport::all();
        $date = Carbon::now()->format('Y-m-d');
        return view('user.index', compact('date','flights', 'airports'));
    }

    public function flightList()
    {
        return view('user.flight-list');
    }

    public function returnflightList()
    {
        return view('user.return-flight-list');
    }
}