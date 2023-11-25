<div id="seat_card-{{ $i }}" class="card py-4 mt-4 mx-auto rounded-1 container" style="display: none;">
    <h2 class="pb-4">Seat Selection</h2>

    <div class="row">
        <!-- Legends (Left Side) -->
        <div class="col-md-3 mx-auto">
            <h5>Guide to selection seat</h5>
            <div class="card mb-2 rounded-2 bg-yellow">
                <div class="card-body">
                    <span>Premium Seat</span>
                    <p>PHP 390.00</p>
                </div>
            </div>
            <div class="card mb-2 rounded-2 bg-blue">
                <div class="card-body">
                    <span>Standard Plus Seat</span>
                    <p>PHP 245.00</p>
                </div>
            </div>
            <div class="card mb-2 rounded-2 bg-gray">
                <div class="card-body">
                    <span>Standard Seat</span>
                    <p>PHP 200.00</p>
                </div>
            </div>
        </div>

        <!-- Seat Selection (Right Side) -->
        <div class="col-md-9">
            @foreach(array_chunk($seats, 5) as $index => $chunk)
            <div class="row">
                @foreach($chunk as $seat)
                <div class="col-md-2 mx-auto">
                    <label for="{{ $seat }}{{ $i }}"
                        class="card mb-2 rounded-2 {{ $index % 4 == 0 ? 'bg-yellow' : ($index % 4 == 1 ? 'bg-blue' : ($index % 4 == 2 || $index % 4 == 3 ? 'bg-gray' : 'bg-blue')) }}">
                        <div class="card-body">
                            <input value="{{ $seat }}" name="seat[]" type="checkbox" id="{{ $seat }}{{ $i }}" {{
                                in_array($seat, $acquiredSeats) ? 'checked' : '' }} {{ in_array($seat, $acquiredSeats)
                                ? 'disabled' : '' }}>
                            <span>{{ $seat }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .bg-yellow {
        background: #FAFF00;
    }

    .bg-blue {
        background: #00A3FF;
    }

    .bg-gray {
        background: #D9D9D9;
    }
</style>

<script>


</script>

{{-- <script>
    // Script 1: Seat selection script

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize an array to store selected seats
        var selectedSeats = [];

        // Variable to store the total value
        var totalValue = 0;

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[name="seat[]"]');

        checkboxes.forEach(function (checkbox) {
            // Add an event listener to each checkbox
            checkbox.addEventListener('change', function () {
                // Check if the checkbox is checked
                if (this.checked) {
                    // Determine the value based on the seat index
                    var seatValue = getSeatValue(this.value);

                    // Add the seat value to the selectedSeats array
                    selectedSeats.push({ seat: this.value, value: seatValue });

                    // Update the total value
                    totalValue = calculateTotalValue(selectedSeats);

                    // Display the total value on the screen
                    displayTotalValue(totalValue);
                } else {
                    // Remove the seat value from the selectedSeats array
                    var index = selectedSeats.findIndex(function (seat) {
                        return seat.seat === this.value;
                    }.bind(this));

                    if (index !== -1) {
                        selectedSeats.splice(index, 1);
                    }

                    // Update the total value
                    totalValue = calculateTotalValue(selectedSeats);

                    // Display the total value on the screen
                    displayTotalValue(totalValue);
                }

                // Log the current selected seats and total value
                // console.log('Selected Seats:', selectedSeats);
                // console.log('Total Value:', totalValue);
            });
        });

        console.log('Total Value:', totalValue);

        // Function to determine the value based on the seat index
        function getSeatValue(seat) {
            var row = seat.charAt(0);
            var column = parseInt(seat.substring(1));

            if ((row === 'A' && column >= 1 && column <= 5)) {
                return 390;
            } else if(row === 'B' && column >= 1 && column <= 6) {
                return 245;
            }


            else if ((row === 'C' && column >= 1 && column <= 5) ||
                (row === 'D' && column >= 1 && column <= 5)) {
                return 200;
            } else {
                return 0; // Default value if seat does not match any criteria
            }
        }

        // Function to calculate the total value of selected seats
        function calculateTotalValue(seats) {
            return seats.reduce(function (total, seat) {
                return total + seat.value;
            }, 0);
        }

        // Function to display the total value on the screen
        function displayTotalValue(value) {
            // Update the content of the totalValueElement with the calculated total value
            totalValueElement.textContent = 'Total Value: ' + value;
        }
    });
</script> --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize an array to store selected seats
        var selectedSeats = [];

        // Variable to store the total value
        var totalValue = 0;

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[name="seat[]"]');

        checkboxes.forEach(function (checkbox) {
            // Add an event listener to each checkbox
            checkbox.addEventListener('change', function () {
                // Check if the checkbox is checked
                if (this.checked) {
                    // Determine the value based on the seat index
                    var seatValue = getSeatValue(this.value);

                    // Add the seat value to the selectedSeats array
                    selectedSeats.push({ seat: this.value, value: seatValue });

                    // Update the total value
                    totalValue = calculateTotalValue(selectedSeats);
                } else {
                    // Remove the seat value from the selectedSeats array
                    var index = selectedSeats.findIndex(function (seat) {
                        return seat.seat === this.value;
                    }.bind(this));

                    if (index !== -1) {
                        selectedSeats.splice(index, 1);
                    }

                    // Update the total value
                    totalValue = calculateTotalValue(selectedSeats);
                }

                // Log the current selected seats and total value
                console.log('Selected Seats:', selectedSeats);
                console.log('Total Value:', totalValue);
            });
        });

        // Function to determine the value based on the seat index
        function getSeatValue(seat) {
            var row = seat.charAt(0);
            var column = parseInt(seat.substring(1));

            if ((row === 'A' && column >= 1 && column <= 5) ||
                (row === 'B' && column >= 1 && column <= 6)) {
                return 390;
            } else if ((row === 'C' && column >= 1 && column <= 5) ||
                (row === 'D' && column >= 1 && column <= 5)) {
                return 200;
            } else {
                return 0; // Default value if seat does not match any criteria
            }
        }

        // Function to calculate the total value of selected seats
        function calculateTotalValue(seats) {
            return seats.reduce(function (total, seat) {
                return total + seat.value;
            }, 0);
        }
    });
</script> --}}


{{--
<!-- Add this script to your HTML file -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize an array to store selected seats
        var selectedSeats = [];

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[name="seat[]"]');

        checkboxes.forEach(function (checkbox) {
            // Add an event listener to each checkbox
            checkbox.addEventListener('change', function () {
                // Check if the checkbox is checked
                if (this.checked) {
                    // Add the seat value to the selectedSeats array
                    selectedSeats.push(this.value);
                } else {
                    // Remove the seat value from the selectedSeats array
                    var index = selectedSeats.indexOf(this.value);
                    if (index !== -1) {
                        selectedSeats.splice(index, 1);
                    }
                }

                // Log the current selected seats (you can replace this with your desired logic)
                console.log('Selected Seats:', selectedSeats);
            });
        });
    });
</script> --}}