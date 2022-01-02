<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;

class InsetStat extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_stats';

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
    protected $fillable = ['type', 'inset_id', 'social'];

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

        $items = InsetStat::query()->select('inset_stats.inset_id', 'inset_stats.type', 'inset_stats.social', DB::raw('COUNT(inset_stats.type) as count'))
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->from, function($query) use ($request) {
                $from = Carbon::parse($request->from)->toDateTimeString();
                $query->where('created_at', '>=', $from);
            })
            ->when($request->till, function($query) use ($request) {
                $till = Carbon::parse($request->till)->toDateTimeString();
                $query->where('created_at', '<=', $till);
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->type, function($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->social, function($query) use ($request) {
                $query->where('social', $request->social);
            })
            ->groupBy('social')
            ->groupBy('type')
            ->groupBy('inset_id')
            ->with('insets')
            ->paginate();

        return $items;
    }

    public function getCharts(Request $request) {
        $order_by = $this->getOrderBy($request);
        $items = InsetStat::query();
        $periodData = $this->countPeriod($request->chartsPeriod ? $request->chartsPeriod : 'week');

        if($periodData['byDay'] && !empty($periodData['byDay'])) {
            $items = $items->select(DB::raw("DATE_FORMAT(created_at, '%d.%m') date"),  
                                    DB::raw('DAY(created_at) day'), 
                                    DB::raw('COUNT(inset_stats.type) as count'), 
                                    'inset_stats.inset_id', 'inset_stats.type', 'inset_stats.social')
            ->groupBy('day');
        } else {
            $items = $items->select(DB::raw("DATE_FORMAT(created_at, '%m.%Y') date"),  
                                    DB::raw('MONTH(created_at) month'), 
                                    DB::raw('COUNT(inset_stats.type) as count'), 
                                    'inset_stats.inset_id', 'inset_stats.type', 'inset_stats.social')
                                ->groupBy('month');
        }
        
        $items = $items->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
                })
                ->when($request->chartsPeriod, function($query) use ($periodData) {
                    $query->where('created_at', '>=', $periodData['from'])
                            ->where('created_at', '<=', Carbon::now()->toDateTimeString());
                })
                ->when($request->user_id, function($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                })
                ->when($request->type, function($query) use ($request) {
                    $query->where('type', $request->type);
                })
                ->when($request->social, function($query) use ($request) {
                    $query->where('social', $request->social);
                })
                ->groupBy('social')
                ->get();

        return $items;
    }

    public function countPeriod($period) {
        $periodData = [];
        switch ($period) {
            case 'week':
                $periodData['from'] = Carbon::now()->startOfWeek()->toDateTimeString();
                $periodData['byDay'] = true;
                return $periodData;
                break;
            
            case 'month':
                $periodData['from'] = Carbon::now()->startOfMonth()->toDateTimeString();
                $periodData['byDay'] = true;
                return $periodData;
                break;
                
            case 'quarter':
                $periodData['from'] = Carbon::now()->startOfQuarter()->toDateTimeString();
                $periodData['byDay'] = false;
                return $periodData;
                break;
            
            case 'year':
                $periodData['from'] = Carbon::now()->startOfYear()->toDateTimeString();
                $periodData['byDay'] = false;
                return $periodData;
                break;
            
            default:
                $periodData['from'] = Carbon::now()->startOfWeek()->toDateTimeString();
                $periodData['byDay'] = true;
                return $periodData;
                break;
        }
    }

    public function getTypeNameAttribute() {
        if($this->type == 'joke') {
            return 'Анекдот';
        }

        if($this->type == 'horoscope') {
            return 'Гороскоп';
        }

        return 'Цитата';
    }

    public function insets()
    {
        return $this->belongsTo(InsetContent::class, 'inset_id');
    }

    public function getInsetsAttribute($value) 
    {
        return $this->hasOne(InsetContent::class);
    }
}
