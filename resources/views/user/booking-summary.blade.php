<!-- Modal -->
<div class="modal modal-lg fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h5 style="font-weight: 600">
                        Personal Details
                    </h5>
                </div>
                <div>
                    <span>Name:</span>
                    <span id="first_name_display"></span>
                    <span id="middle_initial_display"></span>
                    <span id="last_name_display"></span>
                    <span id="last_name_display"></span>
                </div>
                <div>
                    <span>Contact Number:</span>
                    <span id="contact_number_display"></span>

                </div>
                <div>
                    <span>Address:</span>
                    <span id="address_display"></span>

                </div>
                <div>
                    <span>Date of Birth:</span>
                    <span id="date_of_birth_display"></span>

                </div>
                <div>
                    <span id="pwd_display"></span>
                </div>

                <div class="mt-2">
                    <h5 style="font-weight: 600">
                        ADDS-ON
                    </h5>
                    Baggage: ₱ <span id="adds_on_baggage_display" style="font-weight: semibold"></span>
                </div>

                <div class="mt-3">
                    <h5 style="font-weight: 600">
                        Flight Details
                    </h5>

                    <div>
                        Flight No.: <span id="flight_no_display"></span>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="bg-primary text-white p-3">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-secondary text-white p-3">Column 2</div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-success text-white p-3">Column 3</div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary">Confirm and Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get references to the input fields and display elements
        const inputs = [
                document.getElementById("first_name"),
                document.getElementById("middle_initial"),
                document.getElementById("last_name"),
                document.getElementById("contact_number"),
                document.getElementById("address"),
                document.getElementById("date_of_birth"),
                document.getElementById("pwd"),
                document.getElementById("flight_no"),

            ];
            const displays = [
                document.getElementById("first_name_display"),
                document.getElementById("middle_initial_display"),
                document.getElementById("last_name_display"),
                document.getElementById("contact_number_display"),
                document.getElementById("address_display"),
                document.getElementById("date_of_birth_display"),
                document.getElementById("pwd_display"),
                document.getElementById("flight_no_display"),
            ];


         // Get radio buttons by name attribute
        const baggageRadios = document.getElementsByName("adds_on_baggage");


        // Add event listener for baggage radio buttons
        for (let i = 0; i < baggageRadios.length; i++) {
            baggageRadios[i].addEventListener("input", updateBaggage);
        }

        // Function to update the data model and UI for radio buttons
        function updateBaggage() {
            const selectedBaggage = Array.from(baggageRadios).find(radio => radio.checked);
            document.getElementById("adds_on_baggage_display").textContent = selectedBaggage.value
            updateUI();
        }


            // Initialize the data model
            var array = [];
            for (let i = 0; i < inputs.length; i++) {
                let element = inputs[i].value;
                array.push(element);
            }

            let dataModel = array;

            // Function to update the UI with the current data model values
            function updateUI() {
                for (let i = 0; i < inputs.length; i++) {
                    dataModel[i] === "" ? displays[i].textContent = "No Entered Data" : displays[i].textContent = dataModel[i];
                    // inputs[6].checked === true ? displays[6].checked = true : displays[6].checked = false
                    inputs[6].checked === true ? displays[6].textContent = "I am a person with disability" : displays[6].textContent = "I am NOT a person with disability"
                }
            }

            // Function to update the data model with the input values
            function updateDataModel(index) {
                dataModel[index] = inputs[index].value;
                updateUI();
            }

            // Add event listeners for input changes and initial UI update
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener("input", (event) => {
                    updateDataModel(i);
                });
            }

            // Initialize the UI with the current data model values
            updateUI();

            if (baggage_checkbox.checked) {
                updateBaggage()
            }
</script>