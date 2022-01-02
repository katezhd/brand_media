<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use Spatie\Activitylog\Traits\LogsActivity;

class InsetContent extends Model
{
    
    use SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_contents';

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
    protected $fillable = ['type', 'name', 'video_code', 'news_id'];

    protected static $logAttributes = ['name', 'position', 'text', 'image', 'video_code', 'inset_id', 'type', 'published_at'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type_name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'imported_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    const IMAGE_CONFIG = [
        'width'  => 1024,
        'height' => 1024,
        'crop'   => false
    ];

    public function getOrderBy(Request $request) 
    {
        $order_by = $request->input('sort');
        if ($order_by) {
            $order_by = explode('|', $order_by);
            $columns  = Schema::getColumnListing($this->table);
            if (!empty($order_by[0]) && in_array($order_by[0], $columns)) {
                $order_by[0] = $order_by[0];
            } else {
                $order_by[0] = 'name';
            }

            if (!empty($order_by[1]) && in_array($order_by[1], ['asc', 'desc'])) {
                $order_by[1] = $order_by[1];
            } else {
                $order_by[1] = 'asc';
            }
        } else {
            $order_by = ['name', 'asc'];
        }
        return $order_by;
    }
    
    public function getAll(Request $request, $type = null)
    {
        $order_by = $this->getOrderBy($request);

        $items = InsetContent::query()->select('inset_contents.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($type != NULL, function($query) use ($type) {
                $query->where('type', $type);
                $query->whereNotNull('imported_at');
            })
            ->when($type == NULL, function($query) use ($type) {
                $query->whereNull('imported_at');
            })
            ->when($request->type, function($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->status == 'editable', function($query) {
                $query->where(function($query){
                    $query->where('type', 'quote');
                    $query->orWhere('type', 'joke');
                    $query->orWhere('type', 'video');
                });
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->with('news')
            ->paginate();
        
        return $items;
    }

    static function getValidationRules() 
    {
        return [
            'type' => 'required|in:quote,joke,horoscope,video,weather,currency',
            'video_code' => 'max:25',
            'name' => 'max:255',
            'text.*' => 'max:255'
        ];
    }

    public function getTypeNameAttribute() {
        if($this->type == 'joke') {
            return 'Анекдот';
        }

        if($this->type == 'horoscope') {
            return 'Гороскоп';
        }

        if($this->type == 'video') {
            return 'Видео';
        }

        if($this->type == 'weather') {
            return 'Погода';
        }

        if($this->type == 'currency') {
            return 'Курс валют';
        }

        return 'Цитата';
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function getNewsAttribute($value) 
    {
        return $this->hasOne(News::class);
    }
}
