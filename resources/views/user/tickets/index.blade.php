@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">My Tickets</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Flight #</th>
                <th scope="col">Destination</th>
                <th scope="col">Origin</th>
                <th scope="col">Airline</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->flight_no }}</td>
                <td>{{ $ticket->destinationAirportLocation }}</td>
                <td>{{ $ticket->originAirportLocation }}</td>
                <td>{{ $ticket->airline }}</td>
                <td><a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary">View Ticket</a></td>
            </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>


@endsection