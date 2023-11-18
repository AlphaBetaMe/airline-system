<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();

        foreach ($flights as $flight) {
            $duration = $flight->duration;
            $formattedDuration = $this->formatDurationForDisplay($duration);
            $flight->formatted_duration = $formattedDuration;
        }

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
        // Define validation rules
        $rules = [
            'flight_type' => 'required',
            'origin_id' => 'required',
            'destination_id' => 'required',
            'departure_date' => 'required|date_format:Y-m-d',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date_format:Y-m-d',
            'arrival_time' => 'required|date_format:H:i',
            'departure_date_return' => 'date_format:Y-m-d',
            'arrival_date_return' => 'date_format:Y-m-d',
            'departure_time_return' => 'date_format:H:i',
            'arrival_time_return' => 'date_format:H:i',
            'price' => 'required|numeric',
            'airline_id' => 'required',
            'flight_number' => 'nullable',
            'return_flight_number' => 'nullable',
        ];

        // Apply the validation rules to the request data
        $request->validate($rules);

        function generateUniqueFlightNumber() {
            $prefix = "PR";
            $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            return $prefix . $randomNumbers;
        }

        $flightNumber = generateUniqueFlightNumber();
        $flightNumberReturn = generateUniqueFlightNumber();

        $flight = new Flight();
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        $flight->departure_date = $request->input('departure_date');
        $flight->arrival_date = $request->input('arrival_date');
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');

        $flight->departure_date_return = $request->input('departure_date_return');
        $flight->arrival_date_return = $request->input('arrival_date_return');
        $flight->departure_time_return = $request->input('departure_time_return');
        $flight->arrival_time_return = $request->input('arrival_time_return');
        $flight->price = $request->input('price');
        $flight->airline_id = $request->input('airline_id');
        $flight->flight_number = $flightNumber;
        $flight->return_flight_number = $flightNumberReturn;

        //Parse departure and arrival date and time as Carbon DateTime objects
        $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
        $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);

        // Check if arrival time is earlier than departure time
        if ($arrivalDateTime < $departureDateTime) {
            $arrivalDateTime->addDay(); // Add a day to the arrival time
        }

        // Calculate the duration in seconds
        $durationInSeconds = $arrivalDateTime->diffInSeconds($departureDateTime);

        // Calculate days, hours, and minutes
        $days = floor($durationInSeconds / (60 * 60 * 24));
        $hours = floor(($durationInSeconds % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($durationInSeconds % (60 * 60)) / 60);

        // Format the duration
        $duration = "";

        if ($days > 0) {
            $duration .= $days . 'd ';
        }

        if ($hours > 0) {
            $duration .= $hours . 'h ';
        }

        if ($minutes > 0) {
            $duration .= $minutes . 'm';
        }

        $flight->duration = $duration;


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
        function generateUniqueFlightNumber() {
            $prefix = "PR";
            $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            return $prefix . $randomNumbers;
        }

        $flightNumber = generateUniqueFlightNumber();
        $flightNumberReturn = generateUniqueFlightNumber();

        $flight = Flight::find($id);
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        $flight->departure_date = $request->input('departure_date');
        $flight->arrival_date = $request->input('arrival_date');
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');

        $flight->departure_date_return = $request->input('departure_date_return');
        $flight->arrival_date_return = $request->input('arrival_date_return');
        $flight->departure_time_return = $request->input('departure_time_return');
        $flight->arrival_time_return = $request->input('arrival_time_return');
        $flight->price = $request->input('price');
        $flight->airline_id = $request->input('airline_id');
        $flight->flight_number = $flightNumber;
        $flight->return_flight_number = $flightNumberReturn;
        
       // Parse departure and arrival date and time as Carbon DateTime objects
        $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
        $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);

        // Check if arrival time is earlier than departure time
        if ($arrivalDateTime < $departureDateTime) {
            $arrivalDateTime->addDay(); // Add a day to the arrival time
        }

        // Calculate the duration in seconds
        $durationInSeconds = $arrivalDateTime->diffInSeconds($departureDateTime);

        // Calculate days, hours, and minutes
        $days = floor($durationInSeconds / (60 * 60 * 24));
        $hours = floor(($durationInSeconds % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($durationInSeconds % (60 * 60)) / 60);

        // Format the duration
        $duration = "";

        if ($days > 0) {
            $duration .= $days . 'd ';
        }

        if ($hours > 0) {
            $duration .= $hours . 'h ';
        }

        if ($minutes > 0) {
            $duration .= $minutes . 'm';
        }

        $flight->duration = $duration;


        $flight->update();

        return redirect('admin/flight');
    }

    private function formatDurationForDisplay($duration)
    {
        $timeComponents = explode(':', $duration);

        // Check if the exploded array contains at least two elements (hours and minutes)
        if (count($timeComponents) >= 2) {
            list($hours, $minutes) = $timeComponents;

            $days = floor($hours / 24);
            $remainingHours = $hours % 24;

            $formattedDuration = "";

            if ($days > 0) {
                $formattedDuration .= $days . 'd ';
            }

            if ($remainingHours > 0) {
                $formattedDuration .= $remainingHours . 'h ';
            }

            if ($minutes > 0) {
                $formattedDuration .= $minutes . 'm';
            }

            return trim($formattedDuration);
        }

        // If the duration format is incorrect, return the original duration as is
        return $duration;
    }

}
