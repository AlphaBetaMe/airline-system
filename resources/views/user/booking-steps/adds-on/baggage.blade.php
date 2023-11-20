<div id="baggage_card-{{ $i }}" class="baggage_card container rounded card mb-4" style="display: none">
    <h2 class=" mt-2">Baggage</h2>
    <div class="row card-body">
        <!-- First Column: First Name -->
        @auth
        <div class="col-3">
            <span>Passsenger Name: </span>
            <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].firstName"></span>
            <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].lastName"></span>
        </div>

        @endauth

        <!-- Second Column: Radio Buttons -->
        <div class="col-sm-6">
            <div class="form-check radio-baggage-parent-{{ $i }} d-flex justify-content-center">
                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage{{ $i }}[]"
                        id="0kg{{ $i }}" value="0" checked onclick="updateSelectedValue(this)">
                    <label class="form-check-label" for="0kg{{ $i }}">0kg</label>
                </div>
                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage{{ $i }}[]"
                        id="15kg{{ $i }}" value="200" onclick="updateSelectedValue(this)">
                    <label class="form-check-label" for="15kg{{ $i }}">15kg</label>
                </div>

                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage{{ $i }}[]"
                        id="20kg{{ $i }}" value="320" onclick="updateSelectedValue(this)">
                    <label class="form-check-label" for="20kg{{ $i }}">20kg</label>
                </div>

                <div class="me-5">
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage{{ $i }}[]"
                        id="32kg{{ $i }}" value="650" onclick="updateSelectedValue(this)">
                    <label class="form-check-label" for="32kg{{ $i }}">32kg</label>
                </div>

                <div>
                    <input class="form-check-input baggage-option" type="radio" name="adds_on_baggage{{ $i }}[]"
                        id="40kg{{ $i }}" value="1000" onclick="updateSelectedValue(this)">
                    <label class="form-check-label" for="40kg{{ $i }}">40kg</label>
                </div>

            </div>
        </div>

        <div class="col-sm-2">
            Amount: ₱<span id="amount">0</span>
        </div>
    </div>
</div>

<script>
    // Wait for the DOM content to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
            // Select the radio button with id="0kg{{ $i }}" and set it as checked
            const defaultRadioButton = document.getElementById('0kg{{ $i }}');
            if (defaultRadioButton) {
                defaultRadioButton.checked = true;
            }
        });

    // Get all radio buttons with class 'baggage-option'
    const radioButtons_{{ $i }} = document.querySelectorAll('.baggage-option');

    // Function to handle radio button change event
    function handleRadioButtonChange(event) {
        const selectedValue = event.target.value;
        event.target.closest('.baggage_card').querySelectorAll('#amount').forEach((baggagage_amount) => {
            baggagage_amount.textContent = selectedValue;
        });

        // Update the price text based on the selected radio button
        // amountElement
    }

    // Attach change event listener to each radio button
    radioButtons_{{ $i }}.forEach(radioButton => {
        radioButton.addEventListener('change', handleRadioButtonChange);
    });
</script>