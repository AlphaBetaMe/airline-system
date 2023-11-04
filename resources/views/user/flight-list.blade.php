@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class=" container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-2">Flight List</h1>
                    <a href="/" class="btn btn-primary">Change Flight</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Airline</th>
                            <th>Flight No</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Duration</th>
                            <th>Fly Only Price</th>
                            <th>Fly with Baggage Price</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($results as $result)
                        <form action="{{ route('continue-passenger-details', $result->id) }}" method="GET">
                            <input name="origin_id" type="hidden" value="{{ $result->origin_id }}">
                            <input name="destination_id" type="hidden" value="{{ $result->destination_id }}">
                            <input name="flight_type" id="flight_type" type="hidden" value="{{ $result->flight_type }}">
                            <input name="airline" type="hidden" value="{{ $result->airline->airline }}">
                            <input name="id" type="hidden" value="{{ $result->id }}">
                            <input name="departure_date" type="hidden" value="{{ $result->departure_date }}">
                            <input name="departure_date" type="hidden" value="{{ $result->departure_date }}">
                            <input name="arrival_date" type="hidden" value="{{ $result->arrival_date }}">
                            <input name="duration" type="hidden" value="{{ $result->duration }}">
                            <input name="price" type="hidden" value="{{ $result->price }}">
                            <input name="adultPassengers" type="hidden" value="{{ $adult }}">
                            <input name="childPassengers" type="hidden" value="{{ $child }}">
                            <input name="infantPassengers" type="hidden" value="{{ $infant }}">
                            <input name="seatClass" type="hidden" value="{{ $querySeatClass }}">

                            <tr>
                                <td>{{ $result->airline->airline }}

                                </td>
                                <td>{{ $result->id }}</td>
                                <td>{{ $result->departure_date }}</td>
                                <td>{{ $result->arrival_date }}</td>
                                <td>{{ $result->duration }}</td>
                                <td>₱{{ $result->price }}</td>
                                <td>Fly with Baggage Price</td>
                                <td>
                                    @auth
                                    <button type=" submit" class="btn btn-primary">Continue</button>
                                    @else
                                    <a href="/login" class="btn btn-sm btn-primary">Continue</a>
                                    @endauth
                                </td>
                            </tr>

                        </form>
                        @empty
                        <tr>
                            <td style="background: red; padding: .5rem 1reml; color: white;">No matching
                                flights found
                            </td>
                        </tr>
                        @endforelse

                        <!-- Repeat the above 'tr' for each flight -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    if (!window.location.href.includes('passenger-details')) {
        console.log("not passenger details")
        // Clear the localStorage
        localStorage.removeItem('currentStep');
        // Set the initial step to 1
        currentStep = 1;
    }

</script>