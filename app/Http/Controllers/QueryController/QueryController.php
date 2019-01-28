<?php

namespace App\Http\Controllers\QueryController;

use App\Http\Transformers\WeatherStatusTransformer;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QueryController extends Controller
{

    /**
     * Fetch data from only one service
     * @param $city
     * @return \Dingo\Api\Http\Response
     */
    public function current($city)
    {
        if(!($city = City::where('name', $city)->first())) {
            throw new NotFoundHttpException('Unknown City');
        }

        return $this->response->item($city->weatherStatus()->first(), new WeatherStatusTransformer());
        //return "Hello from ".$city;
    }


    /**
     * Fetch data from both of the service
     * @param $city
     * @return \Dingo\Api\Http\Response
     */
    public function all($city)
    {
        if(!($city = City::where('name', $city)->first()))
            throw new NotFoundHttpException('Unknown City');

        return $this->response->collection($city->weatherStatus, new WeatherStatusTransformer());
    }

}
