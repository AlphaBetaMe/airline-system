<?php

namespace App\Http\Controllers\Superadmin;

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
            $formattedDuration = $this->formatDurationForDisplay(
                $flight->departure_date,
                $flight->arrival_date,
                $flight->departure_time,
                $flight->arrival_time
            );
            $flight->formatted_duration = $formattedDuration;
        }

        return view('superadmin.flight.index', compact('flights'));
    }

    public function create()
    {
        $airlines = Airline::all();
        $airports = Airport::all();
        return view('superadmin.flight.create', compact('airlines', 'airports'));
    }

    public function store(Request $request)
    {
     
        $rules = [
            'flight_type' => 'required',
            'origin_id' => 'required',
            'destination_id' => 'required',
            'departure_date' => 'required|date_format:d/m/Y',
            'departure_time' => 'required|date_format:h:iA',
            'arrival_date' => 'required|date_format:d/m/Y',
            'arrival_time' => 'required|date_format:h:iA',
            'departure_date_return' => 'required|date_format:d/m/Y',
            'arrival_date_return' =>  'required|date_format:d/m/Y',
            'departure_time_return' =>'required|date_format:h:iA',
            'arrival_time_return' => 'required|date_format:h:iA',
            'price' => 'required|numeric',
            'airline_id' => 'required',
            'flight_number' => 'nullable',
            'return_flight_number' => 'nullable',
        ];
    
        // Apply the validation rules to the request data
        $request->validate($rules);

       // Check if the departure and arrival locations are the same
        if ($request->input('origin_id') === $request->input('destination_id')) {
            return redirect()->back()->with('error', 'Departure and Arrival must be different.');
        }

        // Check if departure time is in the past
        $departureDateTime = Carbon::createFromFormat('d/m/Y h:iA', $request->input('departure_date') . ' ' . $request->input('departure_time'));

        // Check if arrival time is in the past
        $arrivalDateTime = Carbon::createFromFormat('d/m/Y h:iA', $request->input('arrival_date') . ' ' . $request->input('arrival_time'));

        if ($departureDateTime->isPast()) {
            return redirect()->back()->with('error', 'Departure time cannot be in the past.');
        }

        if ($arrivalDateTime->isPast()) {
            return redirect()->back()->with('error', 'Arrival time cannot be in the past.');
        }

        // Check if departure time and arrival time are the same
        if ($departureDateTime->eq($arrivalDateTime)) {
            return redirect()->back()->with('error', 'Departure time and Arrival time cannot be the same.');
        }

        // Check if there is at least a 1-hour interval between departure and arrival
        if ($arrivalDateTime->diffInMinutes($departureDateTime) < 60) {
            return redirect()->back()->with('error', 'There should be at least a 1-hour interval between Departure and Arrival.');
        }
        
        function generateUniqueFlightNumber() {
            $prefix = "FR";
            $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            return $prefix . $randomNumbers;
        }

        $flightNumber = generateUniqueFlightNumber();
        $flightNumberReturn = generateUniqueFlightNumber();

        $flight = new Flight();
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        // Convert departure and arrival dates to 'Y-m-d' format
        $flight->departure_date = Carbon::createFromFormat('d/m/Y', $request->input('departure_date'))->format('Y-m-d');
        $flight->arrival_date = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date'))->format('Y-m-d');

        // Convert departure and arrival times to 'H:i' format (24-hour)
        $flight->departure_time = Carbon::createFromFormat('h:iA', $request->input('departure_time'))->format('H:i');
        $flight->arrival_time = Carbon::createFromFormat('h:iA', $request->input('arrival_time'))->format('H:i');

        // Convert return departure and arrival dates to 'Y-m-d' format
        $flight->departure_date_return = Carbon::createFromFormat('d/m/Y', $request->input('departure_date_return'))->format('Y-m-d');
        $flight->arrival_date_return = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date_return'))->format('Y-m-d');

        // Convert return departure and arrival times to 'H:i' format (24-hour)
        $flight->departure_time_return = Carbon::createFromFormat('h:iA', $request->input('departure_time_return'))->format('H:i');
        $flight->arrival_time_return = Carbon::createFromFormat('h:iA', $request->input('arrival_time_return'))->format('H:i');



        // Calculate the duration and format it for display
        $formattedDuration = $this->formatDurationForDisplay(
            $flight->departure_date,
            $flight->arrival_date,
            $flight->departure_time,
            $flight->arrival_time
        );

        $flight->duration = $formattedDuration;
        $flight->return_flight_number = $flightNumberReturn;
        $flight->price = $request->input('price');
        $flight->airline_id = $request->input('airline_id');        
      
        // Calculate the duration as a DateInterval
        $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
        $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);
        $duration = $arrivalDateTime->diff($departureDateTime);

        $days = $duration->d;
        $hours = $duration->h;
        $minutes = $duration->i;

        $formattedDuration = "";

        if ($days > 0) {
            $formattedDuration .= $days . 'd ';
        }

        if ($hours > 0) {
            $formattedDuration .= $hours . 'h ';
        }

        if ($minutes > 0) {
            $formattedDuration .= $minutes . 'm';
        }

     
        $flight->flight_number = $flightNumber;
        $flight->save();
        return redirect('superadmin/flight-lists')->with('success', 'Flight Added Successfully');
    }

    public function edit($id)
    {
        $flights = Flight::find($id);
        $airlines = Airline::all();
        $airports = Airport::all();

        // Format date and time for departure display 
        $flights->formatted_departure_date = Carbon::parse($flights->departure_date)->format('d/m/Y');
        $flights->formatted_arrival_date = Carbon::parse($flights->arrival_date)->format('d/m/Y');
        $flights->formatted_departure_time = Carbon::parse($flights->departure_time)->format('h:iA');
        $flights->formatted_arrival_time = Carbon::parse($flights->arrival_time)->format('h:iA');
        
        // Format date and time for return display
        $flights->formatted_departure_date_return = Carbon::parse($flights->departure_date_return)->format('d/m/Y');
        $flights->formatted_arrival_date_return = Carbon::parse($flights->arrival_date_return)->format('d/m/Y');
        $flights->formatted_departure_time_return = Carbon::parse($flights->departure_time_return)->format('h:iA');
        $flights->formatted_arrival_time_return = Carbon::parse($flights->arrival_time_return)->format('h:iA');
        return view('superadmin.flight.edit', compact('flights', 'airlines', 'airports'));
    }

    public function update(Request $request, $id)
    {
        // Find the flight by its ID
        $flight = Flight::find($id);
    
        $rules = [
        'flight_type' => 'required',
        'origin_id' => 'required',
        'destination_id' => 'required',
        'departure_date' => 'required|date_format:d/m/Y',
        'departure_time' => 'required|date_format:h:iA',
        'arrival_date' => 'required|date_format:d/m/Y',
        'arrival_time' => 'required|date_format:h:iA',
        'departure_date_return' => 'required|date_format:d/m/Y',
        'arrival_date_return' =>  'required|date_format:d/m/Y',
        'departure_time_return' =>'required|date_format:h:iA',
        'arrival_time_return' => 'required|date_format:h:iA',
        'price' => 'required|numeric',
        'airline_id' => 'required',
        'flight_number' => 'nullable',
        'return_flight_number' => 'nullable',
    ];

    // Apply the validation rules to the request data
    $request->validate($rules);

   // Check if the departure and arrival locations are the same
    if ($request->input('origin_id') === $request->input('destination_id')) {
        return redirect()->back()->with('error', 'Departure and Arrival must be different.');
    }

    // Check if departure time is in the past
    $departureDateTime = Carbon::createFromFormat('d/m/Y h:iA', $request->input('departure_date') . ' ' . $request->input('departure_time'));

    // Check if arrival time is in the past
    $arrivalDateTime = Carbon::createFromFormat('d/m/Y h:iA', $request->input('arrival_date') . ' ' . $request->input('arrival_time'));

    if ($departureDateTime->isPast()) {
        return redirect()->back()->with('error', 'Departure time cannot be in the past.');
    }

    if ($arrivalDateTime->isPast()) {
        return redirect()->back()->with('error', 'Arrival time cannot be in the past.');
    }

    // Check if departure time and arrival time are the same
    if ($departureDateTime->eq($arrivalDateTime)) {
        return redirect()->back()->with('error', 'Departure time and Arrival time cannot be the same.');
    }

    // Check if there is at least a 1-hour interval between departure and arrival
    if ($arrivalDateTime->diffInMinutes($departureDateTime) < 60) {
        return redirect()->back()->with('error', 'There should be at least a 1-hour interval between Departure and Arrival.');
    }
    
    function generateUniqueFlightNumber() {
        $prefix = "FR";
        $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        return $prefix . $randomNumbers;
    }

    $flightNumber = generateUniqueFlightNumber();
    $flightNumberReturn = generateUniqueFlightNumber();

    $flight = new Flight();
    $flight->flight_type = $request->input('flight_type');
    $flight->origin_id = $request->input('origin_id');
    $flight->destination_id = $request->input('destination_id');
    // Convert departure and arrival dates to 'Y-m-d' format
    $flight->departure_date = Carbon::createFromFormat('d/m/Y', $request->input('departure_date'))->format('Y-m-d');
    $flight->arrival_date = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date'))->format('Y-m-d');

    // Convert departure and arrival times to 'H:i' format (24-hour)
    $flight->departure_time = Carbon::createFromFormat('h:iA', $request->input('departure_time'))->format('H:i');
    $flight->arrival_time = Carbon::createFromFormat('h:iA', $request->input('arrival_time'))->format('H:i');

    // Convert return departure and arrival dates to 'Y-m-d' format
    $flight->departure_date_return = Carbon::createFromFormat('d/m/Y', $request->input('departure_date_return'))->format('Y-m-d');
    $flight->arrival_date_return = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date_return'))->format('Y-m-d');

    // Convert return departure and arrival times to 'H:i' format (24-hour)
    $flight->departure_time_return = Carbon::createFromFormat('h:iA', $request->input('departure_time_return'))->format('H:i');
    $flight->arrival_time_return = Carbon::createFromFormat('h:iA', $request->input('arrival_time_return'))->format('H:i');



    // Calculate the duration and format it for display
    $formattedDuration = $this->formatDurationForDisplay(
        $flight->departure_date,
        $flight->arrival_date,
        $flight->departure_time,
        $flight->arrival_time
    );

    $flight->duration = $formattedDuration;
    $flight->return_flight_number = $flightNumberReturn;
    $flight->price = $request->input('price');
    $flight->airline_id = $request->input('airline_id');        
  
    // Calculate the duration as a DateInterval
    $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
    $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);
    $duration = $arrivalDateTime->diff($departureDateTime);

    $days = $duration->d;
    $hours = $duration->h;
    $minutes = $duration->i;

    $formattedDuration = "";

    if ($days > 0) {
        $formattedDuration .= $days . 'd ';
    }

    if ($hours > 0) {
        $formattedDuration .= $hours . 'h ';
    }

    if ($minutes > 0) {
        $formattedDuration .= $minutes . 'm';
    }

 
    $flight->flight_number = $flightNumber;
        // Save the updated flight
        $flight->update();
    
        // Redirect to the flight list or a relevant page
        return redirect('superadmin/flight-lists')->with('success', 'Flight Updated Successfully');
    }
    private function formatDurationForDisplay($departureDate, $arrivalDate, $departureTime, $arrivalTime)
    {
        $departureDateTime = Carbon::parse($departureDate . ' ' . $departureTime);
        $arrivalDateTime = Carbon::parse($arrivalDate . ' ' . $arrivalTime);
        $duration = $arrivalDateTime->diff($departureDateTime);

        $days = $duration->d;
        $hours = $duration->h;
        $minutes = $duration->i;

        $formattedDuration = "";

        if ($days > 0) {
            $formattedDuration .= $days . 'd ';
        }

        if ($hours > 0) {
            $formattedDuration .= $hours . 'h ';
        }

        if ($minutes > 0) {
            $formattedDuration .= $minutes . 'm';
        }

        return trim($formattedDuration);
    }
}
