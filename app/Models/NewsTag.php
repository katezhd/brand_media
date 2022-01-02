<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class NewsTag extends Model
{
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_tags_rel';

    /**
     * Per page value.
     *
     * @var integer
     */
    protected $perPage = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['news_id', 'tag_id'];

    protected static $logAttributes = ['news_id','tag_id'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    
    public $timestamps = false;

    static function getValidationRules() 
    {
        return [
            'tag_id'  => 'required|exists:tags,id',
            'news_id' => 'required|exists:news,id'
        ];
    }
}
