@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<form class="form" action="">
    <div class="container step" id="step1">
        <div class="card" style="max-width: 800px; margin: 3rem auto;">
            <div class="card-body">

                <!-- This inputs is need to store after booking (submitting the form) -->
                <input name="flight_type" id="flight_type" type="hidden" value="{{ $result->flight_type }}">
                <input name="airline" id="airline" type="hidden" value="{{ $result->airline->airline }}">
                <input name="flight_no" id="flight_no" type="hidden" value="{{ $result->id }}">
                <input name="departure_date" id="departure_date" type="hidden" value="{{ $result->departure_date }}">
                <input name="arrival_date" id="arrival_date" type="hidden" value="{{ $result->arrival_date }}">
                <input name="duration" id="duration" type="hidden" value="{{ $result->duration }}">
                <input name="price" id="price" type="hidden" value="{{ $result->price }}">
                <input name="adultPassengers" id="adultPassengers" type="hidden" value="{{ $adult }}">
                <input name="childPassengers" id="childPassengers" type="hidden" value="{{ $child }}">
                <input name="infantPassengers" id="infantPassengers" type="hidden" value="{{ $infant }}">

                <div>
                    <h2 class="text-center text-decoration-underline mb-4">Passenger Details

                    </h2>
                </div>
                <div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="mb-2">Last Name</label>

                            <input type="text" value="{{ Auth::user()->last_name }}" id="last_name" class="form-control"
                                name="last_name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="mb-2">First Name</label>

                            <input type="text" value="{{ Auth::user()->first_name }}" id="first_name"
                                class="form-control" name="first_name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middle_initial" class="mb-2">Middle Initial</label>
                            <input type="text" value="" id="middle_initial" class="form-control" name="middle_initial"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="contact_number" class="mb-2">Contact Number</label>
                            <input type="text" value="" id="contact_number" class="form-control" name="contact_number"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address" class="mb-2">Address</label>
                            <input type="text" value="" id="address" class="form-control" name="address" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth" class="mb-2">Date of Birth</label>
                            <input type="date" value="" id="date_of_birth" class="form-control" name="date_of_birth"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 border-bottom  pb-2">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" name="pwd" id="pwd">
                        <label class="ms-2" for="pwd">I am a Person with disability (PWD)</label for="pwd">
                    </div>
                </div>

                <div class="row mb-3 ">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <label class="ms-2" for="special_asssitance">Do you need special assistance?</label
                            for="special_asssitance">
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance" value="yes" id="special_asssitance_yes">
                            <label for="special_asssitance_yes">Yes</label>
                        </div>
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance" value="no" id="special_asssitance_no">
                            <label for="special_asssitance_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="button" onclick="nextStep(2)" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- adds on --}}
    @include('user.booking-steps.add-ons')
</form>
@endsection

<style>
    .step {
        display: none;
    }
</style>

<script>
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