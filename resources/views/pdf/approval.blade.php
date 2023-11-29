{{--
<!DOCTYPE html>
<html>

<head>
    <title>Approval PDF</title>
</head>

<body>
    <h1>E-TICKET</h1>

    <h2>Passenger Details</h2>
    @php
    $firstNames = explode('|', $ticket->first_name);
    $lastNames = explode('|', $ticket->last_name);
    $middleInitials = explode('|', $ticket->middle_initial);
    $contactNumbers = explode('|', $ticket->contact_number);
    $addresses = explode('|', $ticket->address);
    $dateOfBirths = explode('|', $ticket->date_of_birth);
    $specialAssistances = explode('|', $ticket->special_assistance);
    @endphp

    @foreach ($firstNames as $index => $firstName)
    <p>Passenger {{ $index + 1 }}:</p>
    <p>First Name: {{ $firstName ?? '' }}</p>
    <p>Last Name: {{ $lastNames[$index] ?? '' }}</p>
    <p>Middle Initial: {{ $middleInitials[$index] ?? '' }}</p>
    <p>Contact Number: {{ $contactNumbers[$index] ?? '' }}</p>
    <p>Address: {{ $addresses[$index] ?? '' }}</p>
    <p>Date of Birth: {{ $dateOfBirths[$index] ?? '' }}</p>
    <p>Special Assistance: {{ $specialAssistances[$index] ?? '' }}</p>
    @endforeach

    <!-- Adds-On Baggage Details -->
    <h2>Adds-On Baggage Details</h2>
    @php
    $addsOnBaggage = explode('|', $ticket->adds_on_baggage);
    @endphp

    @foreach ($addsOnBaggage as $index => $baggageAmount)
    <p>Baggage {{ $index + 1 }}:</p>
    <p>Amount: {{ $baggageAmount ?? '' }}</p>
    @endforeach

    <!-- Return Flight Details (if applicable) -->
    @if ($ticket->flight_type == 'round_trip')
    <h2>Return Flight Details</h2>
    <p>Departure Date: {{ $ticket->departure_date_return ?? '' }}</p>
    <p>Arrival Date: {{ $ticket->arrival_date_return ?? '' }}</p>
    <p>Departure Time: {{ $ticket->departureTimeReturn ?? '' }}</p>
    <p>Arrival Time: {{ $ticket->arrivalTimeReturn ?? '' }}</p>
    <!-- Add more return flight details as needed -->
    @endif


</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #3498db;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 20px;
        }

        p {
            margin: 5px 0;
        }

        .passenger-details {
            margin-top: 15px;
            border: 1px solid #bdc3c7;
            padding: 10px;
            border-radius: 5px;
        }

        .baggage-details {
            margin-top: 15px;
            border: 1px solid #bdc3c7;
            padding: 10px;
            border-radius: 5px;
        }

        .return-flight-details {
            margin-top: 15px;
            border: 1px solid #bdc3c7;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>E-TICKET</h1>


    <h2>Passenger Details</h2>
    @php
    $firstNames = explode('|', $ticket->first_name);
    $lastNames = explode('|', $ticket->last_name);
    $middleInitials = explode('|', $ticket->middle_initial);
    $contactNumbers = explode('|', $ticket->contact_number);
    $addresses = explode('|', $ticket->address);
    $dateOfBirths = explode('|', $ticket->date_of_birth);
    $specialAssistances = explode('|', $ticket->special_assistance);
    @endphp


    <div class="passenger-details">
        <h2>Passenger Details</h2>
        @foreach ($firstNames as $index => $firstName)
        <p>Passenger {{ $index + 1 }}:</p>
        <p>First Name: {{ $firstName ?? '' }}</p>
        <p>Last Name: {{ $lastNames[$index] ?? '' }}</p>
        <p>Middle Initial: {{ $middleInitials[$index] ?? '' }}</p>
        <p>Contact Number: {{ $contactNumbers[$index] ?? '' }}</p>
        <p>Address: {{ $addresses[$index] ?? '' }}</p>
        <p>Date of Birth: {{ $dateOfBirths[$index] ?? '' }}</p>
        <p>Special Assistance: {{ $specialAssistances[$index] ?? '' }}</p>
        @endforeach
    </div>

    @php
    $addsOnBaggage = explode('|', $ticket->adds_on_baggage);
    @endphp

    <div class="baggage-details">
        <h2>Adds-On Baggage Details</h2>
        @foreach ($addsOnBaggage as $index => $baggageAmount)
        <p>Baggage {{ $index + 1 }}:</p>
        <p>Amount: {{ $baggageAmount ?? '' }}</p>
        @endforeach
    </div>

    @if ($ticket->flight_type == 'round_trip')
    <div class="return-flight-details">
        <h2>Return Flight Details</h2>
        <p>Departure Date: {{ $ticket->departure_date_return ?? '' }}</p>
        <p>Arrival Date: {{ $ticket->arrival_date_return ?? '' }}</p>
        <p>Departure Time: {{ $ticket->departureTimeReturn ?? '' }}</p>
        <p>Arrival Time: {{ $ticket->arrivalTimeReturn ?? '' }}</p>
        <!-- Add more return flight details as needed -->
    </div>
    @endif
</body>

</html>