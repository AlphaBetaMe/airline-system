<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $airports = Airport::all();
        $date = Carbon::now()->format('Y-m-d');
        if (auth()->check()) {
            if(auth()->user()->role == 'superadmin') {
                abort(403, "You can't access this page");
            }
        }
        return view('frontend.index', compact('date', 'flights', 'airports'));
    }
}