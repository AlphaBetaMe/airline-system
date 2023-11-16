@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">My Tickets</h1>

    <div class="card">
        <div class="card-body">
            <table class="table text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" >Flight #</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Airline</th>
                        <th scope="col">Status</th>
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
                        <td>{{ $ticket->status == '0' ? 'Pending' : ($ticket->status == '1' ? 'Approved' : 'Canceled') }}</td>
                        <td><a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">View Ticket</a></td>
                    </tr>
                    @endforeach

                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
