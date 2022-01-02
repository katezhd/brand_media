<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Spatie\Activitylog\Traits\LogsActivity;

class InsetWeather extends Model
{
    use LogsActivity;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'day',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_weather';

    public $timestamps = false;

    public function getAll(Request $request)
    {
        $items = InsetWeather::query()->select('inset_weather.*')
            ->when($request->city_id, function($query) use ($request) {
                $query->where('city_id', $request->city_id);
            })
            ->with('city')
            ->orderBy('id', 'asc')->get();
        return $items;
    }

    public function city()
    {
        return $this->belongsTo(InsetWeatherCity::class, 'city_id');
    }

    public function getCityAttribute($value) 
    {
        return $this->hasOne(InsetWeatherCity::class);
    }
}
