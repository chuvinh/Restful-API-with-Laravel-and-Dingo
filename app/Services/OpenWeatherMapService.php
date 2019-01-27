<?php

namespace App\Services;

use App\Models\WeatherStatus;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class OpenWeatherMapService
{
    /**
     * Fetching data from openweathermap.org
     * @param string $apiKey
     * @param Collection $cities
     * @return Collection
     */
    public function query(string $apiKey, Collection $cities) : Collection
    {
        $result = collect();

        // create a guzzle client and set base url in the constructor
        $guzzleClient = new Client([
            'base_uri' => 'https://api.openweathermap.org'
        ]);

        foreach($cities as $city)
        {
            $response = $guzzleClient->get('data/2.5/weather', [
                'query' => [
                    'units' => 'metric',
                    'APPID' => $apiKey,
                    'q'     => $city->name,
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            //create object and save data
            $status = new WeatherStatus();
            $status->city()->associate($city);
            $status->temp_celsius   = $response['main']['temp'];   // read the documentation of the api of openweathermap.org
            $status->status         = $response['weather'][0] ? $response['weather'][0]['main'] : '';
            $status->last_update    = Carbon::createFromTimestamp($response['dt']);
            $status->provider       = 'openweathermap.org';
            $status->save();

            $result->push($status);
        }
        return $result;
    }
}