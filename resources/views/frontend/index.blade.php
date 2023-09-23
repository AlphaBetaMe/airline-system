@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container">
    <div class="text-center mt-5">
        <h1>Let’s explore & travel</h1>
        <p class="intro">Provide the best destinations!</p>
    </div>

        <div class="card" style="max-width: 800px; margin: 0 auto;">
            <div class="card-body">
                <form>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flight_type" id="roundtripOption" value="round_trip" checked>
                            <label class="form-check-label" for="roundtripOption">
                                Round-Trip
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flight_type" id="onewayOption" value="one_way">
                            <label class="form-check-label" for="onewayOption">
                                One-Way
                            </label>
                        </div>
                    </div>
                    
                    <div id="roundtripContent">
                        <!-- Content for Roundtrip -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="origin_id" class="mb-2">From</label>
                                <select class="form-select" id="origin_id" name="origin_id" required>
                                    <option value="" disabled selected>Choose Origin</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="destination_id" class="mb-2">To</label>
                                <select class="form-select" name="destination_id" required>
                                    <option value="" disabled selected>Choose Destination</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-4">
                                <label for="departure_date" class="mb-2">Departure Date</label>   
                                <input type="date" class="form-control" name="departure_date" placeholder=" " required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="arrival_date" class="mb-2">Return Date</label>
                                <input type="date" class="form-control" name="arrival_date" placeholder=" " required>
                            </div>
                            <div class="col-4">
                                <label for="seatClassRoundtrip" class="mb-2">Seat Class</label>
                                <select class="form-select" id="seatClassRoundtrip" name="seatClassRoundtrip">
                                    <option value="economy">Economy</option>
                                    <option value="business">Business</option>
                                    <option value="first_class">First Class</option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-start mb-3">
                            <div class="col-2">
                                <label for="adultPassengers" class="mb-2">Adults</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementAdults">-</button>
                                    <input type="number" class="form-control small-input" id="adultPassengers" name="adultPassengers" value="1" min="1">
                                    <button type="button" class="btn btn-primary" id="incrementAdults">+</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="childPassengers" class="mb-2">Children</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementChildren">-</button>
                                    <input type="number" class="form-control small-input" id="childPassengers" name="childPassengers" value="0" min="10">
                                    <button type="button" class="btn btn-primary" id="incrementChildren">+</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="infantPassengers" class="mb-2">Infants</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementInfants">-</button>
                                    <input type="number" class="form-control small-input" id="infantPassengers" name="infantPassengers" value="0" min="10">
                                    <button type="button" class="btn btn-primary" id="incrementInfants">+</button>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div id="onewayContent" style="display: none;">
                        <!-- Content for Oneway -->
                       <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="origin_id" class="mb-2">From</label>
                                <select class="form-select" id="origin_id" name="origin_id" required>
                                    <option value="" disabled selected>Choose Origin</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="destination_id" class="mb-2">To</label>
                                <select class="form-select" name="destination_id" required>
                                    <option value="" disabled selected>Choose Destination</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-4">
                                <label for="departure_date" class="mb-2">Departure Date</label>   
                                <input type="date" class="form-control" name="departure_date" placeholder=" " required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="seatClassRoundtrip" class="mb-2">Seat Class</label>
                                <select class="form-select" id="seatClassRoundtrip" name="seatClassRoundtrip">
                                    <option value="economy">Economy</option>
                                    <option value="business">Business</option>
                                    <option value="first_class">First Class</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="adultPassengers" class="mb-2">Adults</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementAdults">-</button>
                                    <input type="number" class="form-control small-input" id="adultPassengers" name="adultPassengers" value="1" min="1">
                                    <button type="button" class="btn btn-primary" id="incrementAdults">+</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="childPassengers" class="mb-2">Children</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementChildren">-</button>
                                    <input type="number" class="form-control small-input" id="childPassengers" name="childPassengers" value="0" min="10">
                                    <button type="button" class="btn btn-primary" id="incrementChildren">+</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="infantPassengers" class="mb-2">Infants</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="decrementInfants">-</button>
                                    <input type="number" class="form-control small-input" id="infantPassengers" name="infantPassengers" value="0" min="10">
                                    <button type="button" class="btn btn-primary" id="incrementInfants">+</button>
                                </div>
                            </div>
                        </div>             
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Search Flights</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to radio buttons
        const roundtripOption = document.getElementById('roundtripOption');
        const onewayOption = document.getElementById('onewayOption');
        const roundtripContent = document.getElementById('roundtripContent');
        const onewayContent = document.getElementById('onewayContent');
        
        roundtripOption.addEventListener('change', () => {
            roundtripContent.style.display = 'block';
            onewayContent.style.display = 'none';
        });
        
        onewayOption.addEventListener('change', () => {
            roundtripContent.style.display = 'none';
            onewayContent.style.display = 'block';
        }); 
    });


</script>

@endsection
