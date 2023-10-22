<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_type',
        'airline',
        'flight_no',
        'departure_date',
        'duration',
        'price',
        'adultPassengers',
        'childPassengers',
        'infantPassengers',
        'originAirportCode',
        'destinationAirportCode',
        'destinationAirportLocation',
        'originAirportName',
        'destinationAirportName',
        'originAirportLocation',
        'departureTime',
        'arrivalTime',
        'seat',
        'last_name',
        'first_name',
        'middle_initial',
        'contact_number',
        'address',
        'date_of_birth',
        'pwd',
        'special_asssitance',
        'adds_on_baggage',
        'cancel',
    ];

}
