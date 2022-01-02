<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Spatie\Activitylog\Traits\LogsActivity;

class InsetWeatherCity extends Model
{
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_weather_cities';


    public $timestamps = false;

    public function getAll(Request $request)
    {
        $items = InsetWeatherCity::query()->select('inset_weather_cities.*')->orderBy('id', 'asc')->get();

        return $items;
    }
}
