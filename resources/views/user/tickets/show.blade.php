@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container  my-5 step">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-2 text-center text-primary">TICKETS</h2>
                    <div class="d-flex align-items-center justify-content-between">
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                            data-bs-target="#myModal">Cancel Flight</button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#myModal">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @php $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers; @endphp

    @php
    $first_names = explode('|', $ticket->first_name);
    $middle_initials = explode('|', $ticket->middle_initial);
    $last_names = explode('|', $ticket->last_name);
    @endphp



    @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="card rounded-2  my-2">
        <header class="bg-primary py-3 rounded-2">
            <div class="row">
                <div class="col-md-8 d-flex justify-content-between px-5">
                    <h3>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <span class="brand-letter brand-letter-a">A</span>
                            <span class="brand-letter brand-letter-f">F</span>
                            <span class="brand-letter brand-letter-r">R</span>
                            <span class="brand-letter brand-letter-s">S</span>
                        </a>
                    </h3>
                    <div class="mr-3">
                        <h5 class="fw-bold m-0 text-white">BOARDING PASS</h5>
                        <p class="fw-normal text-uppercase text-center m-0 p-0 text-white">{{ $ticket->seatClass
                            }} CLASS
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mr-3">
                        <h5 class="fw-bold m-0 text-white">BOARDING PASS</h5>
                        <p class="fw-normal text-uppercase  m-0 p-0 text-white">{{ $ticket->seatClass
                            }} CLASS
                        </p>
                    </div>
                </div>
            </div>



        </header>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Content for the wider first column goes here -->
                        <div class="row mb-3 ">
                            <div class="col-md-4 text-left ">
                                <p class="m-0 text-muted">Airline</p>
                                <h5>{{ $ticket->airline }}</h5>
                                <!-- Content for the first column goes here -->
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">From</p>
                                <h5>{{ $ticket->destinationAirportLocation }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">To</p>
                                <h5>{{ $ticket->originAirportName }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Passenger Name</p>
                                <h5>{{ $first_names[$i - 1] }} {{ $middle_initials[$i - 1] }} {{ $last_names[$i - 1] }}
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Flight Number</p>
                                <h5> {{ substr($ticket->flight_no, 0, 2) }} {{ substr($ticket->flight_no, 2) }}</h5>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Date</p>
                                <h5>{{ $ticket->departure_date }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Gate</p>
                                <h5>{{ $ticket->gate }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Seat</p>
                                <h5>{{ $ticket->seat }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Departure</p>
                                <h5>{{ $ticket->departureTime }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Arrival</p>
                                <h5>{{ $ticket->arrivalTime }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 dashed-border">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Flight Number</p>
                                <h6 class="fw-bold"> {{ substr($ticket->flight_no, 0, 2) }} {{
                                    substr($ticket->flight_no, 2) }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Airline</p>
                                <h6 class="fw-bold">{{ $ticket->airline }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Passenger Name</p>
                                <h6 class="fw-bold">
                                    {{ $first_names[$i - 1] }} {{ $middle_initials[$i - 1] }} {{ $last_names[$i - 1] }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">From</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->destinationAirportLocation }}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <p class="m-0 text-muted">To</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->originAirportLocation }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Date</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->departure_date }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Gate</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->gate }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Seat</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->seat }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Departure</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->departureTime }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Arrival</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->arrivalTime }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>
@endfor
</div>


@endsection

<style>
    .dashed-border {
        border-left: 1px dashed #000;
        /* You can adjust the color and width */
        padding-left: 10px;
        /* Add padding to separate content from the border */
    }
</style>