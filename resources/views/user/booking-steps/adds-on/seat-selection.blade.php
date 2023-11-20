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