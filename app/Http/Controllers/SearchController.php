<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Http\Request;

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
        return view('user.flight-list', compact('results', 'adult', 'child', 'infant'));
    }

    public function passengerDetails(Request $request, $id)
    {
        $queryOrigin = $request->input('origin_id');
        $queryDestination = $request->input('destination_id');
        $queryDeparture = $request->input('departure_date');
        $queryArrival = $request->input('arrival_date');


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

            return view('user.booking-steps.passenger-details', compact('result', 'adult', 'child', 'infant'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // User not found
            abort(404, 'Resource not found');
        }
    }
}
