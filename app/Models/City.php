<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function weatherStatus()
    {
        return $this->hasMany(WeatherStatus::class);
    }

}