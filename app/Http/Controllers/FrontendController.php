<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $airports = Airport::all();
        return view('frontend.index', compact('flights', 'airports'));
    }
}
