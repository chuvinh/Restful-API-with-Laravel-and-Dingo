<?php


namespace App\Http\Transformers;

use App\Models\WeatherStatus;
use League\Fractal\TransformerAbstract;

class WeatherStatusTransformer extends TransformerAbstract
{

    public function transform(WeatherStatus $weatherStatus)
    {
        return [
            'id'                =>  $weatherStatus->id,
            'city_id'           =>  $weatherStatus->city_id,
            'city_name'         =>  $weatherStatus->city->name,
            'temp_celsius'      =>  $weatherStatus->temp_celsius,
            'provider'          =>  $weatherStatus->provider,
            'status'            =>  $weatherStatus->status,
            'measurement_time'  =>  $weatherStatus->last_update,
            'created_at'        =>  $weatherStatus->created_at,
        ];
    }

}