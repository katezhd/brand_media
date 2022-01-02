<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends Model
{
    
    use SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

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
    protected $fillable = [
        'name',
        'is_system',
        'meta_title',
        'meta_description'
    ];

    protected static $logAttributes = [
        'name', 
        'uri', 
        'published_at',
        'meta_title',
        'meta_description'
    ];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

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
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        $items = Tag::query()->select('tags.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->when($request->status == 'visible', function($query) {
                $query->whereNotNull('published_at');
                $query->whereNull('deleted_at');
            })
            ->when($request->status == 'hidden', function($query) {
                $query->whereNull('published_at');
            })
            ->when($request->is_system == '1', function($query) {
                $query->where('is_system', 1);
            })
            ->when($request->is_system == '0', function($query) {
                $query->where('is_system', 0);
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->with('news')
            ->paginate();
        
        return $items;
    }

    static function getValidationRules($id = null) 
    {
        return [
            'name' => $id ? 'unique:tags,name,' . $id . ',id,deleted_at,NULL|max:255' :
                'required|unique:tags,name,NULL,id,deleted_at,NULL|max:255',
        ];
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }
}
