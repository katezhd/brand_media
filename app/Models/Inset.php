<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

use Spatie\Activitylog\Traits\LogsActivity;

class Inset extends Model
{
    
    use SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insets';

    /**
     * Per page value.
     *
     * @var integer
     */
    protected $perPage = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'data', 'position'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type_name', 'category', 'left', 'right'];

        /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    protected static $logAttributes = ['type', 'position'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    const INSETS_LIST = ['quote','joke','horoscope','video','weather','currency'];

    public function getOrderBy(Request $request) 
    {
        $order_by = $request->input('sort');
        if ($order_by) {
            $order_by = explode('|', $order_by);
            $columns  = Schema::getColumnListing($this->table);
            if (!empty($order_by[0]) && in_array($order_by[0], $columns)) {
                $order_by[0] = $order_by[0];
            } else {
                $order_by[0] = 'position';
            }

            if (!empty($order_by[1]) && in_array($order_by[1], ['asc', 'desc'])) {
                $order_by[1] = $order_by[1];
            } else {
                $order_by[1] = 'asc';
            }
        } else {
            $order_by = ['position', 'asc'];
        }
        return $order_by;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        if ($request->user()) {
            $this->perPage = 30;
        }

        $items = Inset::query()->select('insets.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->type, function($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->status == 'visible', function($query) {
                $query->whereNotNull('published_at');
                $query->whereNull('deleted_at');
            })
            ->when($request->status == 'hidden', function($query) {
                $query->whereNull('published_at');
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->paginate($this->perPage);

        return $items;
    }

    static function getValidationRules($id = null) 
    {
        return [
            'type' => 'required|in:categories,videos,custom,random',
            'position' => $id ? 'required|unique:insets,position,' . $id . ',id,deleted_at,NULL|max:255' :
                'unique:insets,position,NULL,id,deleted_at,NULL|max:255',
        ];
    }

    public function getTypeNameAttribute() {
        if($this->type == 'categories') {
            return 'Слайдер категории';
        }

        if($this->type == 'videos') {
            return 'Слайдер видео';
        }

        if($this->type == 'random') {
            return 'Случайные инфо-блоки';
        }

        return 'Инфо-блоки';
    }

    public function insets()
    {
        return $this->hasMany(InsetContent::class, 'inset_id', 'id');
    }

    public function getCategoryAttribute() 
    {
        if($this->data && array_key_exists('category_id', $this->data)) {
            return Category::find($this->data['category_id']);
        }
        
        return null;
    }

    public function getLeftAttribute() 
    {
        if($this->type == 'random') {
            $type = Arr::random(Inset::INSETS_LIST, 1)[0];
            if($type == 'quote' || $type == 'joke' || $type == 'video') {
                return InsetContent::with('news')->where('type', $type)
                                    ->whereNull('imported_at')
                                    ->inRandomOrder()->first();
            } else {
                return $type;
            }
        } 
        
        if($this->data && array_key_exists('left_id', $this->data)) {
            return InsetContent::with('news')->where('type', $this->data['left_id'])
                                ->whereNull('imported_at')
                                ->inRandomOrder()->first();
        }
        
        return null;
    }
    
    public function getRightAttribute() 
    {
        if($this->type == 'random') {
            $type = Arr::random(Inset::INSETS_LIST, 1)[0];
            if($type == 'quote' || $type == 'joke' || $type == 'video') {
                return InsetContent::with('news')->where('type', $type)
                                    ->whereNull('imported_at')
                                    ->inRandomOrder()->first();
            } else {
                return $type;
            }
        } 
        
        if($this->data && array_key_exists('right_id', $this->data)) {
            return InsetContent::with('news')->where('type', $this->data['right_id'])
                                ->whereNull('imported_at')
                                ->inRandomOrder()->first();
        }
        
        return null;
    }
}
