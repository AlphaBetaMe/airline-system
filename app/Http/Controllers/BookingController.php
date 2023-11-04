<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'user_id' => 'nullable',
            'flight_type' => 'nullable',
            'airline' => 'nullable',
            'flight_no' => 'nullable',
            'departure_date' => 'nullable',
            'duration' => 'nullable',
            'price' => 'nullable',
            'adultPassengers' => 'nullable',
            'childPassengers' => 'nullable',
            'infantPassengers' => 'nullable',
            'originAirportCode' => 'nullable',
            'destinationAirportCode' => 'nullable',
            'destinationAirportLocation' => 'nullable',
            'originAirportName' => 'nullable',
            'destinationAirportName' => 'nullable',
            'originAirportLocation' => 'nullable',
            'departureTime' => 'nullable',
            'arrivalTime' => 'nullable',
            'seat' => 'nullable',
            'last_name' => 'nullable',
            'first_name' => 'nullable',
            'middle_initial' => 'nullable',
            'contact_number' => 'nullable',
            'address' => 'nullable',
            'date_of_birth' => 'nullable',
            'pwd' => 'nullable',
            'special_asssitance' => 'nullable',
            'adds_on_baggage' => 'nullable',
            'seatClass' => 'nullable',
            'gate' => 'nullable',
            'cancel' => 'nullable',
        ]);

        $last_name = $request->input('last_name');
        $first_name = $request->input('first_name');
        $middle_initial = $request->input('middle_initial');
        $contact_number = $request->input('contact_number');
        $address = $request->input('address');
        $date_of_birth = $request->input('date_of_birth');
        $pwd = $request->input('pwd') ;



      $numberofPassengers = $request->input('adultPassengers') +  $request->input('childPassengers') + $request->input('infantPassengers');


    for ($i = 1; $i <= $numberofPassengers; $i++) {
        $specialAssistance[]  = $request->input("special_asssitance{$i}")[0];
    }

    if (is_null($request->seat)) {
        $seat = $this->generateRandomSeat();
    } else {
        $seat = $request->seat;
    }


        Booking::create([
            'user_id' => auth()->user()->id,
            'flight_type' => $request->input('flight_type'),
            'airline' => $request->input('airline'),
            'flight_no' => $request->input('flight_no'),
            'departure_date' => $request->input('departure_date'),
            'duration' => $request->input('duration'),
            'price' => $request->input('price'),
            'adultPassengers' => $request->input('adultPassengers'),
            'childPassengers' => $request->input('childPassengers'),
            'infantPassengers' => $request->input('infantPassengers'),
            'originAirportCode' => $request->input('originAirportCode'),
            'destinationAirportCode' => $request->input('destinationAirportCode'),
            'destinationAirportLocation' => $request->input('destinationAirportLocation'),
            'originAirportName' => $request->input('originAirportName'),
            'destinationAirportName' => $request->input('destinationAirportName'),
            'originAirportLocation' => $request->input('originAirportLocation'),
            'departureTime' => $request->input('departureTime'),
            'arrivalTime' => $request->input('arrivalTime'),
            'seat' => /* $this->generateRandomSeat(), */ $seat,
            'last_name' => implode('|',$last_name),
            'first_name' => implode('|',$first_name),
            'middle_initial' => implode('|',$middle_initial),
            'contact_number' => implode('|',$contact_number),
            'address' => implode('|',$address),
            'date_of_birth' => implode('|',$date_of_birth),
            'pwd' => !empty($pwd) ? implode('|', $pwd) : null,
            'special_asssitance' => implode('|',$specialAssistance),
            'adds_on_baggage' => $request->input('adds_on_baggage'),
            'seatClass' => $request->input('seatClass'),
            'gate' => $this->generateRandomGate(),
            'cancel' => $request->input('cancel'),
        ]);


        return redirect()->back();
    }


    /* Seat */
    public function generateRandomSeat()
        {
            $rows = ['A', 'B', 'C', 'D'];
            $columns = ['1', '2', '3', '4', '5'];

            $randomRow = array_rand($rows);
            $randomColumn = array_rand($columns);

            $randomSeat = $rows[$randomRow] . $columns[$randomColumn];

            return $randomSeat;
        }

        /* Gate */


    function generateRandomGate() {
        // Define characters for gates
        $characters = 'ABCDEFGHI';
        $numbers = '123456789';

        // Generate random character from 'A' to 'I'
        $randomChar = $characters[rand(0, strlen($characters) - 1)];

        // Generate random number from '1' to '9'
        $randomNumber = $numbers[rand(0, strlen($numbers) - 1)];

        // Concatenate the random character and number to form the gate
        $randomGate = $randomChar . $randomNumber;

        return $randomGate;
    }



    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
