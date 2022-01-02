<?php

namespace App\Http\Controllers\Web;

use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * @group Web News
 *
 * API для работы с просмотром новости для фронта.
 */

class NewsController extends Controller
{
    /**
     * List of news
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam category string URI категории (для получения списка новостей по категории)
     * @queryParam author string URI автора (для получения списка новостей одного автора)
     * @queryParam tag string URI тега (для получения списка новостей по одному тегу)
     * @queryParam main string Запрос для получения новостей для главной ленты
     * @queryParam status string Статус отображения (возможные значения visible, hidden)
     * @return Response
     */

    public function index(Request $request)
    {
        $news  = new News();
        $news_list['news'] = $news->getAll($request);
        
        if($request->main) {
            $news_list['blocks'] = News::query()->select('news.*')
                        ->whereNotNull('position')
                        ->where('position', 'LIKE', "{$request->page}.%")
                        ->where('published_at', '<=', Carbon::now()->toDateTimeString())
                        ->whereNotNull('published_at')
                        ->orderBy('position', 'asc')
                        ->with('category')
                        ->get();
        }
        
        if ($request->category && $request->page == 1) {
            $category = collect([
                'category' => Category::where('uri', $request->category)->first()
            ]);
            $news_list = $category->merge($news_list);
        }

        if ($request->tag && $request->page == 1) {
            $tag = collect([
                'tag' => Tag::where('uri', $request->tag)->first()
            ]);
            $news_list = $tag->merge($news_list);
        }

        if ($request->author && $request->page == 1) {
            $author = collect([
                'author' => Author::where('uri', $request->author)->first()
            ]);
            $news_list = $author->merge($news_list);
        }

        return response()->json($news_list);
    }

    /**
     * Get specified News
     *
     * @param  Request  $request
     * @param  string  $uri
     * @return Response
     */
    public function show(Request $request, $uri)
    {
        $news = News::with(['author', 'category', 'tags'])
                ->where('uri', $uri)
                ->where('is_published', 1)
                ->where('published_at', '<=', Carbon::now()->toDateTimeString())
                ->first();

        if (!$news) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $news->makeHidden([
            'author_id',
            'category_id',
            'updated_by',
            'published_by',
            'publish_date',
            'publish_time',
            'views',
            'is_published',
            'is_delayed',
            'created_at'
        ]);

        // Обновляем количество просмотров так,
        // чтобы не изменялось значение updated_at
        News::where('id', $news->id)->update([
            'views' => DB::raw('views + 1'),
            'updated_at' => DB::raw('updated_at')
        ]);
        
        return response()->json($news);
    }

    /**
     * Update News
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam social string required Название социальной сети
     * @return Response
     */
    public function update(Request $request, $id)
    {    
        News::where('id', $id)->update([
            $request->social => DB::raw($request->social . ' + 1'),
            'updated_at' => DB::raw('updated_at')
        ]);

        return response()->json($request);
    }
}
