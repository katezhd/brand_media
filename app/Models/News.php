<?php

namespace App\Models;

use App\Helpers\FineDiffHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class News extends Model implements Feedable
{
    
    use SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * Per page value.
     *
     * @var integer
     */
    protected $perPage = 13;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'text',
        'category_id',
        'author_id',
        'meta_title',
        'meta_description',
        'position',
        'is_promo'
    ];

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'publish_date', 
        'publish_time',
        'is_delayed'
    ];

    protected static $logAttributes = [
        'name',
        'text',
        'category_id',
        'author_id',
        'image_alt',
        'image',
        'uri',
        'published_at',
        'meta_title',
        'meta_description',
        'position',
        'is_promo'
    ];
    protected static $ignoreChangedAttributes = ['text'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    const IMAGE_CONFIG = [
        'width'  => 2048,
        'height' => 2048,
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

    public function getPromo(Request $request) {
        $order_by = $this->getOrderBy($request);
        
        $items = News::query()->select('id', 'name', 'position', 'is_promo', 'image')
                ->when($order_by, function($query) use ($order_by) {
                    $query->orderBy($order_by[0], $order_by[1]);
                })
                ->when($request->constructor, function($query) use ($request) {
                    $query->orWhereNotNull('position');
                })
                ->whereNotNull('published_at')
                ->where('published_at', '<=', Carbon::now()->toDateTimeString())
                ->where('is_published', 1)
                ->get();
                
        return $items;
    }
    
    public function getAll(Request $request)
    {
        $order_by = $this->getOrderBy($request);

        if ($request->user()) {
            $this->perPage = 30;
        }

        $items = News::query()->select('news.*')
            ->when($order_by, function($query) use ($order_by) {
                $query->orderBy($order_by[0], $order_by[1]);
            })
            ->when($request->search, function($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->when($request->status == 'delayed', function($query) {
                $query->whereNotNull('published_at');
                $query->where('published_at', '>', Carbon::now()->toDateTimeString());
            })
            ->when($request->status == 'visible', function($query) {
                $query->whereNotNull('published_at');
                $query->where('published_at', '<=', Carbon::now()->toDateTimeString());
                $query->where('is_published', 1);
            })
            ->when($request->status == 'hidden', function($query) {
                $query->whereNull('published_at');
                $query->orWhere('is_published', 0);
            })
            ->when($request->category, function($query) use ($request) {
                $query->whereHas('category', function($query) use ($request) {
                    $query->where('uri', $request->category);
                });
            })
            ->when($request->category_id, function($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->author, function($query) use ($request) {
                $author_id = Author::find(1)->where('uri', $request->author)->first();
                if($author_id->id) {
                    $query->where('author_id', $author_id->id);
                }
            })
            ->when($request->author_id, function($query) use ($request) {
                $query->where('author_id', $request->author_id);
            })
            ->when($request->tag, function($query) use ($request) {
                $query->whereHas('tags', function($query) use ($request) {
                    $query->where('uri', $request->tag);
                    $query->where('is_system', 0);
                });
            })
            ->when($request->tag_id, function($query) use ($request) {
                $query->whereHas('tags', function($query) use ($request) {
                    $query->where('tags.id', $request->tag_id);
                });
            })
            ->when($request->except, function($query) use ($request) {
                $except = explode('.', $request->except);
                $query->whereNotIn('id', $except);
            })
            ->when($request->video, function($query) use ($request) {
                $query->where('is_video', 1);
            })
            ->when($request->user_id, function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->from, function($query) use ($request) {
                $from = Carbon::parse($request->from)->toDateTimeString();
                $query->where('created_at', '>=', $from);
            })
            ->when($request->till, function($query) use ($request) {
                $till = Carbon::parse($request->till)->toDateTimeString();
                $query->where('created_at', '<=', $till);
            })
            ->when(!$request->category, function($query) {
                $query->with('category');
            })
            ->when($request->position_free || $request->main, function($query) {
                $query->whereNull('position');
            })
            ->with('author')
            ->when($request->user(), function($query) {
                $query->with('updater');
                $query->with('publisher');
            })
            ->paginate($this->perPage);
            

        $items->setCollection($items->getCollection()->makeHidden([
            'author_id',
            'category_id',
            'updated_by',
            'published_by',
            'publish_date',
            'publish_time',
            'text',
        ]));
            
        return $items;
    }

    public function getCharts(Request $request) {
        $order_by = $this->getOrderBy($request);
        $items = News::query();
        $periodData = $this->countPeriod($request->chartsPeriod ? $request->chartsPeriod : 'week');

        if($periodData['byDay'] && !empty($periodData['byDay'])) {
            $items = $items->select(DB::raw("DATE_FORMAT(created_at, '%d.%m') date"), 
                                    DB::raw('DAY(created_at) day'), 
                                    DB::raw('COUNT(news.like) as likes'), 
                                    DB::raw('COUNT(news.dislike) as dislikes'), 
                                    DB::raw('COUNT(news.views) as views'), 
                                    DB::raw('COUNT(news.facebook) as facebook'), 
                                    DB::raw('COUNT(news.telegram) as telegram'), 
                                    'news.like', 'news.dislike', 'news.views', 'news.facebook', 'news.telegram')
                                    ->groupBy('day');
        } else {
            $items = $items->select(DB::raw("DATE_FORMAT(created_at, '%m.%Y') date"),  
                                    DB::raw('MONTH(created_at) month'), 
                                    DB::raw('COUNT(news.like) as likes'), 
                                    DB::raw('COUNT(news.dislike) as dislikes'), 
                                    DB::raw('COUNT(news.views) as views'), 
                                    DB::raw('COUNT(news.facebook) as facebook'), 
                                    DB::raw('COUNT(news.telegram) as telegram'), 
                                    'news.like', 'news.dislike', 'news.views', 'news.facebook', 'news.telegram')
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
                ->when($request->author_id, function($query) use ($request) {
                    $query->where('author_id', $request->author_id);
                })
                ->when($request->category_id, function($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->when($request->tag_id, function($query) use ($request) {
                    $query->whereHas('tags', function($query) use ($request) {
                        $query->where('tags.id', $request->tag_id);
                    });
                })
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

    static function getValidationRules($id = null) 
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'name'        => $id ? 'max:255' : 'required|max:255',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->whereNotNull('published_at');
    }

    public function getCategoryAttribute($value) 
    {
        return $this->hasOne(Category::class)->whereNotNull('published_at');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id')->whereNotNull('published_at');
    }

    public function getAuthorAttribute($value) 
    {
        return $this->hasOne(Author::class)->whereNotNull('published_at');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getUpdaterAttribute($value) 
    {
        return $this->hasOne(User::class);
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function getPublisherAttribute($value) 
    {
        return $this->hasOne(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags_rel', 'news_id', 'tag_id')
                    ->where('published_at', '<=', Carbon::now()->toDateTimeString())
                    ->where('is_system', 0);
    }

    public function system_tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags_rel', 'news_id', 'tag_id')
                    ->where('published_at', '<=', Carbon::now()->toDateTimeString())
                    ->where('is_system', 1);
    }

    public function setTags(Request $request) {
        $tag_ids = [];

        if ($request->tag_id)
        {
            $tag_ids = $request->tag_id;
            if (!is_array($tag_ids))
            {
                $tag_ids = [$tag_ids];
            }   
        }
        
        $tags_to_detele = NewsTag::where('news_id', $this->id)
            ->whereNotIn('tag_id', $tag_ids)
            ->get();

        foreach ($tags_to_detele as $tag_to_detele) {
            $tag_to_detele->delete();
        }

        $exist_tags = NewsTag::where('news_id', $this->id)->get();
        $exist_tags = $exist_tags->pluck('tag_id');

        foreach ($tag_ids as $tag_id) 
        {
            if (!$exist_tags->contains($tag_id)) {

                $tag = Tag::where('id', $tag_id)->first();

                if (!$tag) {
                    
                    $tag = Tag::create([
                        'name' => $tag_id,
                    ]);

                    $uri = Str::slug($tag_id, '-');
                    $i = 1;
                    while(Tag::where('uri', $uri)->count()) {
                        $uri = $uri . '-' . $i++;
                    }

                    $tag->uri = $uri;
                    $tag->published_at = Carbon::now()->toDateTimeString();
                    $tag->save();

                }

                NewsTag::create([
                    'news_id' => $this->id,
                    'tag_id'  => $tag->id,
                ]);
            }
        }
    }

    public function getPublishDateAttribute()
    {
        if (!$this->published_at)
        {
            return null;
        }
        return Carbon::parse($this->published_at)->setTimezone('Europe/Kiev')->format('Y-m-d');
    }

    public function getPublishTimeAttribute()
    {
        if (!$this->published_at)
        {
            return null;
        }
        return Carbon::parse($this->published_at)->setTimezone('Europe/Kiev')->format('H:i');
    }

    public function getIsDelayedAttribute()
    {
        if (!$this->published_at)
        {
            return false;
        }
        return Carbon::now()->diffInSeconds(Carbon::parse($this->published_at), false) > 0;
    }

    public function toFeedItem(): FeedItem
    {
        $author_str = env('APP_NAME');
        if ($this->author_id) {
            $author = $this->author()->first();
            $author_str = $author->firstname . ' ' . $author->lastname . ' (' . $author_str . ')';
        }
        
        return FeedItem::create()
            ->id($this->id)
            ->title($this->name)
            ->summary($this->meta_description ? $this->meta_description : 'Краткое описание отсутствует')
            ->updated($this->published_at)
            ->author($author_str)
            ->category($this->category()->first()->name)
            ->link('/news/' . $this->uri);
    }

    public static function getFeedItems()
    {
        return News::whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->take(20)->get();
    }
}
