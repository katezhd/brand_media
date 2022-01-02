<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class InsetHoroscope extends Model
{
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_horoscopes';

    public $timestamps = false;

    public function sign()
    {
        return $this->belongsTo(InsetHoroscopeSign::class, 'sign_id');
    }

    public function getSignAttribute($value) 
    {
        return $this->hasOne(InsetHoroscopeSign::class);
    }
}
