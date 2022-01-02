<?php

namespace App\Http\Controllers;

use App\Models\InsetWeather;
use Illuminate\Http\Request;

/**
 * @group weather
 *
 * API для работы с погодой.
 */

class InsetWeatherController extends Controller
{
    
    /**
     * List of weathers
     *
     * @param  Request  $request
     * @queryParam city_id integer ID города
     * @return Response
     */

    public function index(Request $request)
    {
        $weather  = new InsetWeather();
        $weathers = $weather->getAll($request);
        return response()->json($weathers);
    }
}
