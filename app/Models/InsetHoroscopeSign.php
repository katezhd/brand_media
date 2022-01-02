<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Spatie\Activitylog\Traits\LogsActivity;

class InsetHoroscopeSign extends Model
{
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_horoscope_signs';

    public $timestamps = false;

    public function getAll(Request $request)
    {
        $items = InsetHoroscopeSign::query()->select('inset_horoscope_signs.*')->orderBy('id', 'asc')->get();

        return $items;
    }
}
