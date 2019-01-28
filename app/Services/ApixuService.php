<?php

namespace App\Services;

use App\Interfaces\IQueryService;
use App\Models\WeatherStatus;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class ApixuService implements IQueryService
{
    /**
     * Fetching data from Apiux.com
     * @param string $apiKey
     * @param Collection $cities
     * @return Collection
     */
    public function query(string $apiKey, Collection $cities) : Collection
    {
        $result = collect();

        // create a guzzle client and set base url in the constructor
        $guzzleClient = new Client([
            'base_uri' => 'https://api.apixu.com'
        ]);

        foreach($cities as $city)
        {
            $response = $guzzleClient->get('v1/current.json', [
                'query' => [
                    'key'   => $apiKey,
                    'q'     => $city->name,
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            //create object and save data
            $status = new WeatherStatus();
            $status->city()->associate($city);
            $status->temp_celsius   = $response['current']['temp_c'];   // read the documentation of the api of apixu.com
            $status->status         = $response['current']['condition']['text'];
            $status->last_update    = Carbon::createFromTimestamp($response['current']['last_updated_epoch']);
            $status->provider       = 'apixu.com';
            $status->save();

            $result->push($status);
        }
        return $result;
    }
}