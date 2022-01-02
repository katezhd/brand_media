<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

use Spatie\Activitylog\Models\Activity;


class ActivityLog extends Activity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * Per page value.
     *
     * @var integer
     */
    protected $perPage = 30;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['action', 'color', 'property_names', 'property_str'];


    public function isColumnExist($column) 
    {
        return in_array($column, Schema::getColumnListing($this->table));
    }

    public function getOrderBy(Request $request) 
    {
        $order_by = $request->input('sort');
        if ($order_by) {
            $order_by    = explode('|', $order_by);
            if (!empty($order_by[0]) && $this->isColumnExist($order_by[0])) {
                $order_by[0] = $order_by[0];
            } else {
                $order_by[0] = 'id';
            }

            if (!empty($order_by[1]) && in_array($order_by[1], ['asc', 'desc'])) {
                $order_by[1] = $order_by[1];
            } else {
                $order_by[1] = 'desc';
            }
        }
        return $order_by;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);
        

        $subjects = [];
        if ($request->module_id) {
            $module = Module::find($request->module_id);
            $subjects = $module->models;
        }

        $items = $this->query()
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->description, function($query) use ($request) {
                $query->where('description', $request->description);
            })
            ->when($request->subject_id, function($query) use ($request) {
                $query->where('subject_id', $request->subject_id);
            })
            ->when($request->subject_type, function($query) use ($request) {
                $query->where('subject_type', $request->subject_type);
            })
            ->when(count($subjects), function($query) use ($subjects) {
                $query->whereIn('subject_type', $subjects);
            })
            ->when($request->causer_id, function($query) use ($request) {
                $query->where('causer_id', $request->causer_id);
            })
            ->when($request->from, function($query) use ($request) {
                $from = Carbon::parse($request->from)->toDateTimeString();
                $query->where('created_at', '>=', $from);
            })
            ->when($request->till, function($query) use ($request) {
                $till = Carbon::parse($request->till)->toDateTimeString();
                $query->where('created_at', '<=', $till);
            })
            ->when(!$request->with_trashed_causers, function($query) {
                $query->with('causer');
                $query->whereHasMorph('causer', 'App\Models\User', function($query) {
                    $query->whereNull('deleted_at');
                });
            })
            ->when($request->with_trashed_causers && 
                config('activitylog.subject_returns_soft_deleted_models'), function($query) {
                $query->with(['causer' => function(MorphTo $morphTo) {
                    $morphTo->withTrashed();
                }]);
            })
            ->with('subject')
            ->paginate();
        return $items;
    }

    public function getActionAttribute()
    {
        return __($this->description);
    }

    public function getColorAttribute()
    {
        switch ($this->description) {
            case 'created':
                return 'warning';
                break;

            case 'deleted':
                return 'danger';
                break;
            
            default:
                return 'info';
                break;
        }
    }

    public function getPropertyNamesAttribute()
    {
        $changes = collect([]);
        if ($this->properties->has('attributes')) {
            foreach ($this->properties['attributes'] as $key => $value) {
                $changes->push([
                    'name' => __($key)
                ]);
            }
        }

        return $changes->all();
    }

    public function getPropertyStrAttribute()
    {
        $changes = [];
        if ($this->properties->has('attributes')) {
            foreach ($this->properties['attributes'] as $key => $value) {
                array_push($changes, __($key));
            }
        }

        return implode(', ', $changes);
    }

    
    
    public function getPropertiesTexts()
    {
        $activity = $this;

        $properties = array_map(function($pr) use ($activity) {
            $versions = [
                'new' => $pr['new'],
                'old' => $pr['old']
            ];
            
            switch ($pr['key']) {
                case 'city_id':
                    foreach ($versions as $key => $value) {
                        $item = City::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;
                
                case 'role_id':
                    foreach ($versions as $key => $value) {
                        $item = Role::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;

                case 'parking_id':
                    foreach ($versions as $key => $value) {
                        $item = Parking::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;

                case 'details_id':
                    foreach ($versions as $key => $value) {
                        $item = PaymentDetail::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;

                case 'vehicle_id':
                    foreach ($versions as $key => $value) {
                        $item = Vehicle::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->reg . ' ' . $item->model;
                    }
                    break;

                case 'user_id':
                    foreach ($versions as $key => $value) {
                        $item = User::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->lastname . ' ' .  $item->firstname . ' ' .  $item->middlename;
                    }
                    break;

                case 'inspector_id':
                    foreach ($versions as $key => $value) {
                        $item = User::where('id', $value)->withTrashed()->first();
                        $item and $pr[$key . '_text'] = $item->lastname . ' ' .  $item->firstname . ' ' .  $item->middlename;
                    }
                    break;

                case 'module_id':
                    foreach ($versions as $key => $value) {
                        $item = Module::where('id', $value)->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;

                case 'type_id':
                    if ($activity->subject_type == 'App\Models\Offense') {
                        foreach ($versions as $key => $value) {
                            $item = OffenseType::where('id', $value)->withTrashed()->first();
                            $item and $pr[$key . '_text'] = $item->name;
                        }
                    }
                    break;
                
                case 'status_id':
                    if ($activity->subject_type == 'App\Models\Offense') {
                        foreach ($versions as $key => $value) {
                            $item = OffenseStatus::where('id', $value)->first();
                            $item and $pr[$key . '_text'] = $item->name;
                        }
                    }
                    break;
                
                case 'weekday_id':
                    foreach ($versions as $key => $value) {
                        $item = Weekday::where('id', $value)->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;
                
                case 'hour_id':
                    foreach ($versions as $key => $value) {
                        $item = Hour::where('id', $value)->first();
                        $item and $pr[$key . '_text'] = $item->name;
                    }
                    break;
                
                default:
                    break;
            }

            return $pr;
        }, $this->properties->toArray());

        return $properties;
    }

}
