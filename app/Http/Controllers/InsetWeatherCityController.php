<?php

namespace App\Http\Controllers;

use App\Models\InsetWeatherCity;
use Illuminate\Http\Request;

/**
 * @group city
 *
 * API для работы с городами для погоды.
 */

class InsetWeatherCityController extends Controller
{
    
    /**
     * List of cities
     *
     * @param  Request  $request
     * @return Response
     */

    public function index(Request $request)
    {
        $city  = new InsetWeatherCity();
        $cities = $city->getAll($request);
        return response()->json($cities);
    }
}
