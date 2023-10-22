@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
@php $numberofPassengers = $adult + $child + $infant; @endphp
<form class="form" action="{{ route('booking.store') }}" method="POST" x-data="{
    ...formData({
        'inputs': {{ @json_encode(array_fill(0, $numberofPassengers, ['firstName' => '', 'middleInitial' => '', 'lastName' => '', 'contactNumber' => '', 'address' => '', 'dateOfBirth' => ''])) }},
    }),
    'flight_number': '{{ $result->id }}',
    'departure_date':  '{{ \Carbon\Carbon::parse($result->departure_date)->format('M d Y, D.') }}',
    'arrival_date':  '{{ \Carbon\Carbon::parse($result->arrival_date)->format('M d Y, D.') }}',
    'originAirportCode': '{{  $originAirportCode}}',
    'destinationAirportCode': '{{  $destinationAirportCode}}',
    'destinationAirportLocation': '{{  $destinationAirportLocation}}',
    'originAirportLocation': '{{  $originAirportLocation}}',
    'departureTime': '{{ is_string($departureTime) ? \Carbon\Carbon::parse($departureTime)->format('h:i A') : '' }}',
    'arrivalTime': '{{ is_string($arrivalTime) ? \Carbon\Carbon::parse($arrivalTime)->format('h:i A') : '' }}',
    'destinationAirportName': '{{  $destinationAirportName}}',
    'originAirportName': '{{  $originAirportName}}',
}">
    @csrf
    <!-- This inputs is need to store after booking (submitting the form) -->
    <input name="flight_type" id="flight_type" type="hidden" value="{{ $result->flight_type }}">
    <input name="airline" id="airline" type="hidden" value="{{ $result->airline->airline }}">
    <input x-model="flight_number" name="flight_no" id="flight_no" type="hidden">
    <input x-model="departure_date" name="departure_date" id="departure_date" type="hidden">
    <input x-model="arrival_date" name="arrival_date" id="arrival_date" type="hidden">
    <input name="duration" id="duration" type="hidden" value="{{ $result->duration }}">
    <input name="price" id="price" type="hidden" value="{{ $result->price }}">
    <input name="adultPassengers" id="adultPassengers" type="hidden" value="{{ $adult }}">
    <input name="childPassengers" id="childPassengers" type="hidden" value="{{ $child }}">
    <input name="infantPassengers" id="infantPassengers" type="hidden" value="{{ $infant }}">

    <input x-model="originAirportCode" name="originAirportCode" id="originAirportCode" type="hidden">
    <input x-model="destinationAirportCode" name="destinationAirportCode" id="destinationAirportCode" type="hidden">
    <input x-model="destinationAirportLocation" name="destinationAirportLocation" id="destinationAirportLocation"
        type="hidden">
    <input x-model="originAirportName" name="originAirportName" id="originAirportName" type="hidden">
    <input x-model="destinationAirportName" name="destinationAirportName" id="destinationAirportName" type="hidden">

    <input x-model="originAirportLocation" name="originAirportLocation" id="originAirportLocation" type="hidden">
    <input x-model="departureTime" name="departureTime" id="departureTime" type="hidden">
    <input x-model="arrivalTime" name="arrivalTime" id="arrivalTime" type="hidden">


    <div class="container step" id="step1">
        @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="card" style="max-width: 800px; margin: 1rem auto;">
            <div class="card-body">

                <div>
                    <h2 class="text-center text-decoration-underline mb-4">
                        Passenger Details</h2>
                    @if ( $i <= $adult) <h4>Adult </h4>
                        @elseif ($i <=$adult + $child && $child> 0)
                            <h4>Child </h4>
                            @else
                            <h4>Infant </h4>
                            @endif
                </div>
                <div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="last_name{{ $i }}" class="mb-2">Last Name</label>

                            <input type="text" x-model="inputs[{{ $i - 1 }}].lastName" id="last_name{{ $i }}"
                                class="form-control" name="last_name[]" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="first_name{{ $i }}" class="mb-2">First Name</label>

                            <input type="text" x-model="inputs[{{ $i - 1 }}].firstName" id="first_name{{ $i }}"
                                class="form-control" name="first_name[]" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="middle_initial{{ $i }}" class="mb-2">Middle Initial</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].middleInitial" id="middle_initial{{ $i }}"
                                class="form-control" name="middle_initial[]" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="contact_number{{ $i }}" class="mb-2">Contact Number</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].contactNumber" id="contact_number{{ $i }}"
                                class="form-control" name="contact_number[]" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address{{ $i }}" class="mb-2">Address</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].address"" id=" address{{ $i }}"
                                class="form-control" name="address[]" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth{{ $i }}" class="mb-2">Date of Birth</label>
                            <input type="date" x-model="inputs[{{ $i - 1 }}].dateOfBirth" id="date_of_birth{{ $i }}"
                                class="form-control" name="date_of_birth[]" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 border-bottom  pb-2">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" name="pwd[]" id="pwd{{ $i }}">
                        <label class="ms-2" for="pwd{{ $i }}">I am a Person with disability (PWD)</label for="pwd">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <label class="ms-2" for="special_asssitance">Do you need special assistance?</label
                            for="special_asssitance">
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance{{ $i }}[]" value="yes"
                                id="special_asssitance_yes{{ $i }}">
                            <label for="special_asssitance_yes{{ $i }}">Yes</label>
                        </div>
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance{{ $i }}[]" value="no"
                                id="special_asssitance_no{{ $i }}">
                            <label for="special_asssitance_no{{ $i }}">No</label>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    @endfor
    <div class="mt-4 d-flex justify-content-center align-items-center" style="max-width: 800px; margin: 0 auto;">
        <button type="button" onclick="nextStep(2)" class="btn  btn-primary w-100">Proceed</button>
    </div>
    </div>
    @include('user.booking-steps.add-ons')
</form>
@endsection

<style>
    .step {
        display: none;
    }
</style>

<script>
    function formData(data) {
    console.log(data.inputs); // Check the received data structure
    return {
        inputs: data.inputs || [
                {
                    firstName: '',
                    middleInitial: '',
                    lastName: '',
                    contactNumber: '',
                    address: '',
                    dateOfBirth: '',
                }
            ]
    };
}
    // Initialize currentStep from local storage or default to 1
        let currentStep = parseInt(localStorage.getItem('currentStep')) || 1;

        // Function to update the step and store in local storage
        function updateStep(step) {
            // Hide the current step
            document.getElementById('step' + currentStep).style.display = 'none';

            // Show the next/previous step
            document.getElementById('step' + step).style.display = 'block';

            // Update the current step
            currentStep = step;

            // Store the current step in local storage
            localStorage.setItem('currentStep', currentStep.toString());
        }

        // Function to go to the next step
        function nextStep(step) {
            updateStep(step);
            history.pushState({ step: currentStep }, '', window.location.href);
        }

        // Function to go to the previous step and clear local storage
        function prevStep(step) {
            // Clear the currentStep from local storage
            localStorage.removeItem('currentStep');
            // Update the step
            updateStep(step);
            history.pushState({ step: currentStep }, '', window.location.href);
        }

        // When the page loads, set the initial step
        document.addEventListener('DOMContentLoaded', function() {
            updateStep(currentStep);
            // Handle popstate event
            window.addEventListener('popstate', function(event) {
                // Reset the step to 1 if the user navigates back
                currentStep = 1;
                updateStep(currentStep);
            });
        });
</script>