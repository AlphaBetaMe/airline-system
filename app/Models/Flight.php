<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = [
        'flight_type',
        'origin_id',
        'destination_id',
        'departure_date',
        'arrival_date',
        'departure_time',
        'arrival_time',
        'price',
        'airline_id'
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }

    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_id', 'id');
    }
    
    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_id', 'id');
    }

    public function formattedDuration()
{
    $departureTimestamp = strtotime($this->departure_time);
    $arrivalTimestamp = strtotime($this->arrival_time);
    $durationInSeconds = $arrivalTimestamp - $departureTimestamp;

    $hours = floor($durationInSeconds / 3600);
    $minutes = floor(($durationInSeconds % 3600) / 60);

    return $hours . 'h ' . $minutes . 'm';
}

    
}
