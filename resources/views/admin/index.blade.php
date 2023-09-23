@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
        <!-- Admin Dashboard Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-3">
              <div class="col-sm-4 col-xl-4">
                  <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-users fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Passenger</p>
                          <h6 class="mb-0"></h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4 col-xl-4">
                  <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-ticket-alt fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Ticket</p>
                          <h6 class="mb-0"></h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4 col-xl-4">
                  <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-plane fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Airplane</p>
                        <h6 class="mb-0"></h6>
                    </div>
                  </div>
              </div>

          </div>
      </div>
      
      <div class="container-fluid pt-4 px-4">
        <div class="row g-3">
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-check-circle fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Available Airline</p>
                        <h6 class="mb-0">{{ $airlines }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-plane-departure fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Flight</p>
                          <h6 class="mb-0">{{ $flights }}</h6>
                      </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Airports</p>
                        <h6 class="mb-0">{{ $airports }}</h6>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Today's Flight Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Today's Flights</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle table-borderless table-hover mb-0">
                    <thead>
                        <tr class="text-white table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Arrival</th>
                            <th scope="col">Departure</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Airline</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Airport</th>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Today's Flight Issues Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Today's Flight Issues</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle table-borderless table-hover mb-0">
                    <thead>
                        <tr class="text-white table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Arrival</th>
                            <th scope="col">Departure</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Airline</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Airport</th>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      <!-- Admin Dashboard End -->

@endsection
