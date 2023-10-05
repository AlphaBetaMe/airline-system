<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\PassengerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index']);

Auth::routes(['verify' => true]);

// Superadmin Routes
Route::group(['middleware' => ['auth', 'role:superadmin'], 'prefix' => 'superadmin'], function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index']);
});

// Admin Routes
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // Admin Dashboard
    Route::get('dashboard', [AdminController::class, 'index']);

    // Flight Routes
    Route::get('flight', [FlightController::class, 'index']);
    Route::get('create-flight', [FlightController::class, 'create']);
    Route::post('store-flight', [FlightController::class, 'store']);
    Route::get('edit-flight/{id}', [FlightController::class, 'edit']);
    Route::put('update-flight/{id}', [FlightController::class, 'update']);

    // Passenger List Routes
    Route::get('passenger', [PassengerController::class, 'index']);

    // Airline Routes
    Route::get('airline', [AirlineController::class, 'index']);
    Route::get('create-airline', [AirlineController::class, 'create']);
    Route::post('store-airline', [AirlineController::class, 'store']);
    Route::get('edit-airline/{id}', [AirlineController::class, 'edit']);
    Route::put('update-airline/{id}', [AirlineController::class, 'update']);

    // Airport Routes
    Route::get('airport', [AirportController::class, 'index']);
    Route::get('create-airport', [AirportController::class, 'create']);
    Route::post('store-airport', [AirportController::class, 'store']);
    Route::get('edit-airport/{id}', [AirportController::class, 'edit']);
    Route::put('update-airport/{id}', [AirportController::class, 'update']);
});

// Passenger Routes
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user'], function () {
    Route::get('dashboard', [UserController::class, 'index']);
});

// Search
Route::get('/flight-list', [UserController::class, 'flightList']);
Route::get('/search/flight-list', [SearchController::class, 'searchResults'])->name('search-flight.results');
