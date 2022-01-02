<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use Spatie\Activitylog\Traits\LogsActivity;

class Author extends Model
{
    
    use SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';

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
        'firstname',
        'lastname',
        'meta_title',
        'meta_description'
    ];

    protected static $logAttributes = [
        'firstname',
        'lastname',
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

    const IMAGE_CONFIG = [
        'width'  => 576,
        'height' => 576,
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
                $order_by[0] = 'id';
            }

            if (!empty($order_by[1]) && in_array($order_by[1], ['asc', 'desc'])) {
                $order_by[1] = $order_by[1];
            } else {
                $order_by[1] = 'asc';
            }
        } else {
            $order_by = ['id', 'asc'];
        }
        return $order_by;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        $items = Author::query()->select('authors.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->when($request->status == 'visible', function($query) {
                $query->whereNotNull('published_at');
            })
            ->when($request->status == 'hidden', function($query) {
                $query->whereNull('published_at');
            })
            // ->with('news')
            ->paginate();
        
        return $items;
    }

    static function getValidationRules($id = null) 
    {
        return [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
        ];
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id', 'id');
    }
}