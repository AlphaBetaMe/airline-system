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

        $results = Flight::where('origin_id', 'like', '%' . $queryOrigin . '%')
                ->where('destination_id', 'like', '%' . $queryDestination . '%')
                ->where('departure_date', 'like', '%' . $queryDeparture . '%')
                ->where('arrival_date', 'like', '%' . $queryArrival . '%')
                ->get();


        // Redirect to a results page and pass the search results
        return view('user.flight-list', compact('results'));
    }
}
