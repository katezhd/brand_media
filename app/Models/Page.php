<?php

namespace App\Models;

use App\Helpers\FineDiffHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;


class Page extends Model
{
    use SoftDeletes, HasFactory, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
        'image',
        'text', 
        'meta_title',
        'meta_description'
    ];

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
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected static $logAttributes = [
        'name',
        'text',
        'image',
        'uri',
        'published_at',
        'meta_title',
        'meta_description'
    ];
    protected static $ignoreChangedAttributes = ['text'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    const IMAGE_CONFIG = [
        'width'  => 2048,
        'height' => 2048,
        'crop'   => false
    ];
    
    public function tapActivity(Activity $activity, string $eventName)
    {
        if ($this->isDirty('text')) {
            $properties = $activity->properties->toArray();
            $text = strip_tags($properties['attributes']['text']);
            $old_text = '';
            if (array_key_exists('old', $properties)) {
                $old_text = strip_tags($properties['old']['text']);
            }

            if (!strlen($old_text)) {
                $properties['attributes'] = array_merge($properties['attributes'], ['text' => $text]);
            } else {
                $opcodes = FineDiffHelper::getDiffOpcodes($old_text, $text, FineDiffHelper::$wordGranularity);
                $old_opcodes = FineDiffHelper::getDiffOpcodes($text, $old_text, FineDiffHelper::$wordGranularity);

                $opcodes = explode('ccc', $opcodes);
                $old_opcodes = explode('ccc', $old_opcodes);
                
                $phrases = [];
                $old_phrases = [];
        
                foreach ($opcodes as $optcode) {
                    if (strlen($optcode)) {
                        $pieces = \explode(':::', $optcode);
                        if (count($pieces) > 1) {
                            array_shift($pieces);
                            array_push($phrases, '...' . implode(':', $pieces) . '...');
                        }
                    }
                }

                foreach ($old_opcodes as $optcode) {
                    if (strlen($optcode)) {
                        $pieces = \explode(':::', $optcode);
                        if (count($pieces) > 1) {
                            array_shift($pieces);
                            array_push($old_phrases, '...' . implode(':', $pieces) . '...');
                        }
                    }
                }

                if (count($phrases) and count($old_phrases)) {
                    $properties['attributes'] = array_merge($properties['attributes'], ['text' => implode('<br>', $phrases)]);
                    $properties['old'] = array_merge($properties['old'], ['text' => implode('<br>', $old_phrases)]);
                }
    
            }
            $activity->properties = $properties;
        }
    }

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
                $order_by[1] = 'desc';
            }
        }
        return $order_by;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        $items = Page::query()
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->input('search'), function($query) use ($request) {
                $search   = $request->input('search');
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when($request->input('uri'), function($query) use ($request) {
                $query->where('uri', $request->input('uri'));
            })
            ->get()
            ->makeHidden(['text', 'meta_title', 'created_at', 'meta_description']);

        return $items;
    }

    static function getValidationRules($id = null) 
    {
        return [
            'name'       => $id ? 'max:255' : 'required|max:255',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
        ];
    }

}
