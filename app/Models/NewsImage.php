<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class NewsImage extends Model
{
    
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['news_id','image_alt','sort'];

    protected static $logAttributes = ['news_id','image_alt','image','sort'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    static function getValidationRules($id = null) 
    {
        return [
            'news_id' => $id ? 'exists:news,id' : 'required|exists:news,id'
        ];
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function getnewsAttribute($value) 
    {
        return $this->hasOne(News::class);
    }
}
