<!-- Modal -->
<div class="modal modal-lg fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="mb-3">
                    <div>
                        <h5 style="font-weight: 600">
                            Personal Details
                            @if ( $i <= $adult) <h6 class="fw-bold">Adult </h6 class="fw-bold">
                                @elseif ($i <=$adult + $child && $child> 0)
                                    <h6 class="fw-bold">Child </h6 class="fw-bold">
                                    @else
                                    <h6 class="fw-bold">Infant </h6 class="fw-bold">
                                    @endif
                        </h5>
                    </div>
                    <div>
                        <span>Name:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].firstName"></span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].lastName"></span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].middleInitial"></span>
                    </div>
                    <div>
                        <span>Contact Number:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].contactNumber"></span>
                    </div>
                    <div>
                        <span>Address:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].address"></span>
                    </div>
                    <div>
                        <span>Date of Birth:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].dateOfBirth"></span>

                    </div>
                    <div>
                        <span id="pwd_display"></span>
                    </div>
            </div>
            @endfor
            <div class="mt-3">
                <h5 style="font-weight: 600">
                    Flight Details
                </h5>
                <div>

                    <div>
                        <span class="text-primary">
                            Departure
                        </span>
                    </div>
                    <div>
                        Flight No.: <span x-text="flight_number"></span>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between p-3">
                                    <div>
                                        <h5 x-text="originAirportCode">
                                        </h5>
                                        <p x-text="originAirportLocation"></p>
                                    </div>
                                    <div>
                                        <svg fill="#0000ff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                            viewBox="0 0 485.641 485.641" xml:space="preserve" stroke="#0000ff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M467.44,109.264c-25.459-13.141-71.192-23.554-159.117,45.681c-19.059,15.009-107.356,81.918-125.079,98.352 c-17.015,15.779-33.936,31.674-50.548,47.877c-3.772,3.681-7.544,7.362-11.305,11.056l-93.623-44.961 c-8.075-3.884-18.044-1.745-23.735,5.635c-6.535,8.476-4.963,20.645,3.513,27.18l99.087,76.411 c0.309,0.235,20.145,17.165,41.042,5.167c17.429-10.007,34.815-20.109,52.005-30.521c20.242-12.258,40.359-24.715,60.4-37.299 c17.423-10.941,34.736-22.061,51.993-33.264l-4.554,54.834c-1,12.608,7.632,24.328,20.343,26.733 c13.617,2.576,26.746-6.373,29.323-19.99l19.738-104.292c1.603-1.07,3.211-2.127,4.812-3.198 c18.932-12.664,36.955-26.428,54.75-40.682C462.924,172.807,512.506,131.232,467.44,109.264z">
                                                        </path>
                                                        <path
                                                            d="M173.896,216.962l34.464,1.797c23.886-18.829,54.341-42.175,74.378-57.595l-108.842,5.676 c-12.628,0.704-23.079,10.836-23.753,23.755C149.421,204.435,160.055,216.24,173.896,216.962z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 x-text="destinationAirportCode">
                                        </h5>
                                        <p x-text="destinationAirportLocation"></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Departure
                                        {{-- Origin --}}
                                    </h6>
                                    <li x-text="departure_date"></li>
                                    <li x-text="departureTime"></li>
                                    <li x-text="originAirportName"></li>
                                </div>
                            </div>
                            @if ($result->flight_type === "round_trip")
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Return
                                        {{-- Arrivak --}}
                                    </h6>
                                    <li x-text="arrival_date"></li>
                                    <li x-text="arrivalTime"></li>
                                    <li x-text="destinationAirportName"></li>

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-check mt-5">
                    <input class="form-check-input" type="checkbox" id="confirmationCheckbox">
                    <label class="form-check-label" for="confirmationCheckbox">
                        <span class="fw-bold"> I confirm that I have reviewed my reservation summary</span>, and I
                        acknowledge that the price and
                        flight details are correct. I have read and accept the cancellation policy, check-in guidelines,
                        fare rules, and terms and conditions. I acknowledge that it is my responsibility to comply with
                        all the regulations and requirements specified by the airline. By clicking 'Submit,' I affirm
                        that I have read and understood the terms of my reservation. I am aware of the necessary
                        check-in procedures and any associated fees.
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary">Confirm and Continue</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

<script>

</script>