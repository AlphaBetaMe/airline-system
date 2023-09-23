@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-2">Flight List</h1>
                    <a href="#" class="btn btn-primary">Change Flight</a>
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
                        </tr>
                        <tr>
                            <td>Airline Name</td>
                            <td>Flight Number</td>
                            <td>Departure Airport</td>
                            <td>Arrival Airport</td>
                            <td>Flight Duration</td>
                            <td>Fly Only Price</td>
                            <td>Fly with Baggage Price</td>
                        </tr>
                        <!-- Repeat the above 'tr' for each flight -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
