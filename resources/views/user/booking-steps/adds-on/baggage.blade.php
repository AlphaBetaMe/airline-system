<div id="baggage_card" class="container rounded card mb-4" style="display: none">
    <h2 class=" mt-2">Baggage</h2>
    <div class="row card-body">
        <!-- First Column: First Name -->
        @auth
        <div class="col-3">
            <label for="firstName">Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</label>
        </div>

        @endauth

        <!-- Second Column: Radio Buttons -->
        <div class="col-sm-6">
            <div class="form-check d-flex ">
                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage" id="0kg"
                        value="0" checked>
                    <label class="form-check-label" for="0kg">0kg</label>
                </div>
                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage" id="15kg"
                        value="200">
                    <label class="form-check-label" for="15kg">15kg</label>
                </div>

                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage" id="20kg"
                        value="320">
                    <label class="form-check-label" for="20kg">20kg</label>
                </div>

                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage" id="32kg"
                        value="650">
                    <label class="form-check-label" for="32kg">32kg</label>
                </div>

                <div>
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage" id="40kg"
                        value="1000">
                    <label class="form-check-label" for="40kg">40kg</label>
                </div>

            </div>
        </div>

        <div class="col-sm-2">
            Amount: ₱<span id="amount">0</span>
        </div>
    </div>
</div>

<script>
    // Get all radio buttons
    const radioButtons = document.querySelectorAll('.baggage-option');

    // Function to handle radio button change event
    function handleRadioButtonChange() {
        // Loop through radio buttons and find the selected one
        let selectedOption;
        radioButtons.forEach(radioButton => {
            if (radioButton.checked) {
                selectedOption = radioButton.value;
            }
        });

        // Update the price text based on the selected radio button
        const priceText = document.getElementById('amount');
        if (selectedOption === '0') {
            priceText.textContent = '0';
        } else if (selectedOption === '200') {
            priceText.textContent = '200';
        } else if (selectedOption === '320') {
            priceText.textContent = '320';
        }else if (selectedOption === '650') {
            priceText.textContent = '650';
        }else if (selectedOption === '1000') {
            priceText.textContent = '1000';
        }
        // Add more conditions for other radio button values as needed
    }

    let selectedOption;
        radioButtons.forEach(radioButton => {
            if (radioButton.checked) {
                selectedOption = radioButton.value;
            }
        });

        // Update the price text based on the selected radio button
        const priceText = document.getElementById('amount');
        if (selectedOption === '0') {
            priceText.textContent = '0';
        } else if (selectedOption === '200') {
            priceText.textContent = '200';
        } else if (selectedOption === '320') {
            priceText.textContent = '320';
        }else if (selectedOption === '650') {
            priceText.textContent = '650';
        }else if (selectedOption === '1000') {
            priceText.textContent = '1000';
        }


    // Attach change event listener to each radio button
    radioButtons.forEach(radioButton => {
        radioButton.addEventListener('change', handleRadioButtonChange);
    });

</script>