{{-- @php
$seats = [
'A1', 'A2', 'A3', 'A4', 'A5',
'B1', 'B2', 'B3', 'B4', 'B5',
'C1', 'C2', 'C3', 'C4', 'C5',
'D1', 'D2', 'D3', 'D4', 'D5',
// ... other seats
];
@endphp --}}



<div id="seat_card" class="card py-4 mt-4 mx-auto rounded-1 container">
    <h2 class="pb-4">Seat Selection</h2>
    @foreach(array_chunk($seats, 5) as $index => $chunk)
    <div class="row">
        @foreach($chunk as $seat)
        <div class="col-md-2 mx-auto">
            <label for="{{ $seat }}"
                class="card mb-2 rounded-2 {{ $index % 4 == 0 ? 'bg-yellow' : ($index % 4 == 1 ? 'bg-blue' : ($index % 4 == 2 || $index % 4 == 3 ? 'bg-gray' : 'bg-blue')) }}">
                <div class="card-body">
                    {{-- <input type="checkbox" id="{{ $seat }}"> --}}
                    <input value="{{ $seat }}" name="seat" type="checkbox" id="{{ $seat }}" {{ in_array($seat,
                        $acquiredSeats) ? 'checked' : '' }} {{ in_array($seat, $acquiredSeats) ? 'disabled' : '' }}>
                    <span>{{ $seat }}</span>
                </div>
            </label>
        </div>
        @endforeach
    </div>
    @endforeach
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