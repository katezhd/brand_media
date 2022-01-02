<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Reaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reactions';

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
    protected $fillable = ['action', 'news_id', 'token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['deleted_at'];
    public $timestamps = ['created_at'];

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
            $order_by = ['id', 'asc'];
        }
        return $order_by;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        $items = Category::query()->select('reactions.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->paginate();
        
        return $items;
    }

    static function getValidationRules() 
    {
        return [
            'action' => 'required|in:like,dislike',
        ];
    }
}
