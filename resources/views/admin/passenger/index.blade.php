@extends('layouts.admin')
@section('title', 'Passenger')
@section('content')
  <!-- Passenger Lists Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Passenger Lists</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-borderless table-hover mb-0 text-center">
                <thead>
                    <tr class="text-white table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Ticket Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-white">&#8369; </td>
                        <td>
                            <a href="{{ url('') }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Passenger Lists End -->
@endsection
