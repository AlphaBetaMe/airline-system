@extends('layouts.admin')
@section('title', 'Airline')
@section('content')
  <!-- Airline Lists Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Airline Lists</h5>
            <a href="{{ url('admin/create-airline') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Airline</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-borderless table-hover mb-0 text-center">
                <thead>
                    <tr class="text-white table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Airline</th>
                        <th scope="col">Seats</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($airlines as $airline)
                    <tr>
                        <td>{{ $airline->id }}</td>
                        <td><img src="{{ asset('assets/upload/airline/' .$airline->logo) }}" alt="airlinelogo" height="60"></td>
                        <td>{{ $airline->airline }}</td>
                        <td>{{ $airline->total_seats }}</td>
                        <td>
                            <a href="{{ url('admin/edit-airline/'.$airline->id) }}" class="btn btn-success btn-sm">Update</a>
                        </td>
                    </tr>   
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
</div>
  <!-- Airline Lists End -->
@endsection