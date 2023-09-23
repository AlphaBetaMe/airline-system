@extends('layouts.admin')
@section('title', 'Update Airline')
@section('content')
<!-- Update Airline Start -->
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Update Airline</h5>
        <form action="{{ url('admin/update-airline/'.$airlines->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($airlines->logo)
                <img src="{{ asset('assets/upload/airline/' .$airlines->logo) }}" class="mx-auto d-block" alt="airlinelogo" height="280">
            @endif
            <div class="mb-3">
                <label for="formFile" class="form-label">Logo</label>
                <input class="form-control bg-dark" type="file" class="logo">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="airline" placeholder=" " value="{{ $airlines->airline }}">
                <label for="">Airline</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="total_seats" placeholder=" " value="{{ $airlines->total_seats }}">
                <label for="">Total Seats</label>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Update Airline End -->
@endsection
