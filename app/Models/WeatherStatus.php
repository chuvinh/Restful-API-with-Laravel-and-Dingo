<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class WeatherStatus extends Model
{
    public $table = "weather_status";
    public function city()
    {
        return $this->belongsTo(City::class);
    }

}