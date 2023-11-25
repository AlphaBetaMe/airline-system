<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $last_name = $request->input('last_name');
        $first_name = $request->input('first_name');
        $middle_initial = $request->input('middle_initial');
        $contact_number = $request->input('contact_number');
        $address = $request->input('address');
        $date_of_birth = $request->input('date_of_birth');
        $pwd = $request->input('pwd') ;



      $numberofPassengers = $request->input('adultPassengers') +  $request->input('childPassengers') + $request->input('infantPassengers');


      for ($i = 1; $i <= $numberofPassengers; $i++) {
        $specialAssistance[]  = $request->input("special_asssitance{$i}")[0] ?? null;
        $adds_on_baggage[]  = $request->input("adds_on_baggage{$i}")[0] ?? null;

        $ticket_id[] = $this->generateTicketID();


        if (is_null($request->seat)) {
            $seat[] = $this->generateRandomSeat();
        } else {
            $seat = $request->input('seat');
        }
    }

    dd($request->price);

        $totalSeats = DB::table('airlines')->where('airline', $request->input('airline'))->pluck('total_seats')->first();
        $availableSeats = max(0, $totalSeats - $numberofPassengers);
        DB::table('airlines')->where('airline', $request->input('airline'))->update(['total_seats' => $availableSeats]);

        $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'flight_type' => $request->input('flight_type'),
            'airline' => $request->input('airline'),
            'flight_no' => $request->input('flight_no'),
            'departure_date' => $request->input('departure_date'),
            'arrival_date' => $request->input('arrival_date'),
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
            'seat' => /* $this->generateRandomSeat(), */implode('|',$seat),
            'last_name' => implode('|',$last_name),
            'first_name' => implode('|',$first_name),
            'middle_initial' => implode('|',$middle_initial),
            'contact_number' => implode('|',$contact_number),
            'address' => implode('|',$address),
            'date_of_birth' => implode('|',$date_of_birth),
            'pwd' => !empty($pwd) ? implode('|', $pwd) : null,
            'special_asssitance' => implode('|',$specialAssistance),
            'adds_on_baggage' =>  implode('|',$adds_on_baggage),
            'seatClass' => $request->input('seatClass'),
            'gate' => $this->generateRandomGate(),
            'ticket_id' =>  implode('|',$ticket_id),
            'cancel' => $request->input('cancel'),
        ]);

            $bookingId = $booking->id;
            $showUrl = route('tickets.show', ['id' => $bookingId]);

        return redirect($showUrl);
    }


    /* Seat */
    public function generateRandomSeat()
        {
            $rows = ['C', 'D'];
            $columns = ['1', '2', '3', '4', '5'];

            $randomRow = array_rand($rows);
            $randomColumn = array_rand($columns);

            $randomSeat = $rows[$randomRow] . $columns[$randomColumn];

            return $randomSeat;
        }

    /* tikcet id */
    function generateTicketID($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ticketID = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $ticketID .= $characters[mt_rand(0, $maxIndex)];
        }

        return $ticketID;
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

    /* Cancel flight */

    public function cancelFlight(Request $request)
    {
       Booking::where('id', $request->id)->update([
            'status' => 2,
        ]);

        return redirect('tickets');
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
