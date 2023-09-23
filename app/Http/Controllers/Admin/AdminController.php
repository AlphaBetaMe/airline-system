<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $airlines = Airline::count();
        $flights = Flight::count();
        $airports = Airport::count();
        return view('admin.index', compact('airlines', 'flights', 'airports'));
    }
}
