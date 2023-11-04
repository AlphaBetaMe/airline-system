<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchResults(Request $request)
    {
        $queryOrigin = $request->input('origin_id');
        $queryDestination = $request->input('destination_id');
        $queryDeparture = $request->input('departure_date');
        $queryArrival = $request->input('arrival_date');
        $queryAdultPassenger = $request->input('arrival_date');
        $queryArrival = $request->input('adultPassengers');
        $querySeatClass = $request->input('seatClassRoundtrip');

        /* generate the flight id here */

        //* get the flights that match the query */
        $results = Flight::where('origin_id', 'like', '%' . $queryOrigin . '%')
                ->where('destination_id', 'like', '%' . $queryDestination . '%')
                ->where('departure_date', 'like', '%' . $queryDeparture . '%')
                ->where('arrival_date', 'like', '%' . $queryArrival . '%')
                ->get();

        /* get the number of adult, child and infants in query */
         $adult = $request->adultPassengers;
         $child = $request->childPassengers;
         $infant = $request->infantPassengers;


        // Redirect to a results page and pass the search results
        return view('user.flight-list', compact('results', 'querySeatClass', 'adult', 'child', 'infant'));
    }

    public function passengerDetails(Request $request, $id)
    {
        $queryOrigin = $request->input('origin_id');
        $queryDestination = $request->input('destination_id');
        $queryDeparture = $request->input('departure_date');
        $queryArrival = $request->input('arrival_date');
        $querySeatClass = $request->input('seatClass');

        // retrieving the airport data
        $flight = Flight::find($id);


        if ($flight) {
            // origin
            $originAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $queryOrigin)
                            ->first();
            // destination
            $destinationAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $queryDestination)
                            ->first();

            // departure time
            $departureTime =  $flight->departure_time;
            // arrival time
            $arrivalTime =  $flight->arrival_time;

            if ($originAirport) {
                $originAirportCode = $originAirport->code;
                $originAirportName = $originAirport->airport;
                $originAirportLocation = $originAirport->location;
            } else {
                // Handle case where airport with given ID is not found
                dd('origin airport not found');
            }

            if ($destinationAirport) {
                $destinationAirportCode = $destinationAirport->code;
                $destinationAirportName = $destinationAirport->airport;
                $destinationAirportLocation = $destinationAirport->location;
            } else {
                // Handle case where airport with given ID is not found
                dd('destination airport not found');
            }

        } else {
            // Handle case where flight with given ID is not found
            dd('flight not found');
        }


        try {
            $result = Flight::where('origin_id', $queryOrigin)
                        ->where('destination_id', $queryDestination)
                        ->where('departure_date', $queryDeparture)
                        ->where('arrival_date', $queryArrival)
                        ->findorFail($id);
        /* get the number of adult, child and infants in query */
         $adult = $request->adultPassengers;
         $child = $request->childPassengers;
         $infant = $request->infantPassengers;

         $seats = [
            'A1', 'A2', 'A3', 'A4', 'A5',
            'B1', 'B2', 'B3', 'B4', 'B5',
            'C1', 'C2', 'C3', 'C4', 'C5',
            'D1', 'D2', 'D3', 'D4', 'D5',
            // ... other seats
        ];


         $acquiredSeats = Booking::where('originAirportCode', $originAirportCode)->where('destinationAirportCode', $destinationAirportCode)->pluck('seat')->toArray();

            return view('user.booking-steps.passenger-details', compact(
                'originAirportName',  'originAirportLocation', 'destinationAirportName', 'originAirportName',
                'destinationAirportName', 'acquiredSeats',
                'destinationAirportLocation', 'seats', 'querySeatClass',
                'result', 'departureTime', 'arrivalTime', 'adult', 'child', 'infant', 'originAirportCode', 'destinationAirportCode'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // User not found
            abort(404, 'Resource not found');
        }
    }
}
