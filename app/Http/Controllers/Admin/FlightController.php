<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        return view('admin.flight.index', compact('flights'));
    }

    public function create()
    {
        $airlines = Airline::all();
        $airports = Airport::all();
        return view('admin.flight.create', compact('airlines', 'airports'));
    }

    public function store(Request $request)
    {
        $flight = new Flight();
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        $flight->departure_date = $request->input('departure_date');
        $flight->arrival_date = $request->input('arrival_date');
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');
        $flight->price = $request->input('price');
        $flight->airline_id = $request->input('airline_id');
    
        $flight->duration = $flight->formattedDuration();
    
        $flight->save();
    
        return redirect('admin/flight');
    }    


    public function edit($id)
    {
        $flights = Flight::find($id);
        $airlines = Airline::all();
        $airports = Airport::all();
        return view('admin.flight.edit', compact('flights', 'airlines', 'airports'));
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        $flight->departure_date = $request->input('departure_date');
        $flight->arrival_date = $request->input('arrival_date');
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');
        $flight->price = $request->input('price');
        $flight->airline_id = $request->input('airline_id');
    
        $flight->duration = $flight->formattedDuration();
    
        $flight->update();
    
        return redirect('admin/flight');
    }
}
