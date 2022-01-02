<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\News;
use Carbon\Carbon;
use Emuravjev\Mdash\Typograph;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group News
 *
 * API для работы с новостями.
 */

class NewsController extends Controller
{
    
    /**
     * List of news
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam category_id integer ID категории
     * @queryParam tag_id integer ID тега
     * @queryParam author_id integer ID автора
     * @queryParam from string Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @queryParam till string Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @queryParam status string Статус отображения (возможные значения visible, hidden)
     * @return Response
     */

    public function index(Request $request)
    {
        $news  = new News();
        $news_list = $news->getAll($request);
        return response()->json($news_list);
    }

    /**
     * Create news
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam name string required Название новости
     * @bodyParam text string optional Текст новости
     * @bodyParam category_id integer ID категории новости
     * @bodyParam author_id integer ID автора новости
     * @bodyParam image optional Картинка в base64
     * @bodyParam meta:title string optional Содержимое тега <title>
     * @bodyParam meta:description string optional Содержимое тега <meta name="description">
     * @bodyParam tag_id array Массив IDs тегов новости
     * @bodyParam position integer Позиция новости в плашке
     * @bodyParam is_promo integer Промо (возможные значения 1, 0)
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, News::getValidationRules());

        $news = new News($request->all());

        if ($request->image) 
        {
            $news->image = ImageHelper::create_image_from_base64('news', $request->image, News::IMAGE_CONFIG);
        }
        
        // типографирование
        $typograph = new Typograph();
        
        if ($request->use_typograph) {
            $typograph->set_text($request->name);
            $news->name = html_entity_decode(strip_tags($typograph->apply()));
            
            $typograph->set_text($request->text);
            $news->text = $typograph->apply();
        }
        
        if ($request->name) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(News::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $news->uri = $uri;
        }

        if(!$request->is_promo) {
            $news->is_promo = 0;
        }

        // немедленная публикация
        if ($request->publish == 'now') {
            $news->published_at = Carbon::now()->toDateTimeString();
            $news->published_by = $request->user()->id;
            $news->is_published = 1;
        }
        
        // отложенная публикация
        if ($request->publish == 'later') {
            $publish = $request->publish_date . ' ' . $request->publish_time;
            $news->published_at = Carbon::createFromFormat('Y-m-d H:i', $publish, 'Europe/Kiev')
                                    ->setTimezone('UTC')
                                    ->toDateTimeString();
            $news->published_by = $request->user()->id;
            $news->is_published = 1;
        }
        
        if(strpos($request->text, 'article__video-wrap') !== FALSE) {
            $news->is_video = 1;
        } else {
            $news->is_video = 0;
        }

        if ($request->meta_title == $news->name) {
            $news->meta_title = NULL;
        }

        if (!$request->meta_description) {
            $news->meta_description = Str::limit(str_replace(array('"'), '',strip_tags($request['text'])), 160, '');
        }

        $news->save();

        $news->setTags($request);

        return response()->json($news);
    }

    /**
     * Get specified News
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $news = News::with(['author', 'category', 'tags', 'system_tags', 'publisher'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($news);
    }

    /**
     * Update News
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string required Название новости
     * @bodyParam text string optional Текст новости
     * @bodyParam category_id integer ID категории новости
     * @bodyParam author_id integer ID автора новости
     * @bodyParam image string optional Картинка в base64
     * @bodyParam meta:title string optional Содержимое тега <title>
     * @bodyParam meta:description string optional Содержимое тега <meta name="description">
     * @bodyParam tag_id array Массив IDs тегов новости
     * @bodyParam position integer Позиция новости в плашке
     * @bodyParam is_promo integer Промо (возможные значения 1, 0)
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        
        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $this->validate($request, News::getValidationRules($id));

        $news->fill($request->all());

        // типографирование
        $typograph = new Typograph();

        if ($request->use_typograph) {

            $typograph->set_text($request->name);
            $news->name = html_entity_decode(strip_tags($typograph->apply()));

            $typograph->set_text($request->text);
            $news->text = html_entity_decode($typograph->apply());

        }

        if(!$request->is_promo) {
            $news->is_promo = 0;
        }

        if ($request->image) {

            if ($news->image) {
                ImageHelper::remove_image('news/' . $news->image);
                $news->image = null;
            }

            $news->image = ImageHelper::create_image_from_base64('news', $request->image, News::IMAGE_CONFIG);
        }

        if (!$request->image && $request->image_delete) {
            if ($news->image) {
                ImageHelper::remove_image('news/' . $news->image);
                $news->image = null;
            }
        }

        if ($news->wasChanged('name') && !$news->is_published) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(News::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $news->uri = $uri;
        }

        if (!$news->is_published) {
            // немедленная публикация
            if ($request->publish == 'now') {
                $news->published_at = Carbon::now()->toDateTimeString();
                $news->published_by = $request->user()->id;
                $news->is_published = 1;
            }
            
            // отложенная публикация
            if ($request->publish == 'later') {
                $publish = $request->publish_date . ' ' . $request->publish_time;
                $news->published_at = Carbon::createFromFormat('Y-m-d H:i', $publish, 'Europe/Kiev')
                                        ->setTimezone('UTC')
                                        ->toDateTimeString();
                $news->published_by = $request->user()->id;
                $news->is_published = 1;
            }
        } else {

            // снятие с публикации
            if ($request->is_published == 0) {
                $news->published_at = NULL;
                $news->published_by = NULL;
                $news->is_published = 0;
            }

            if ($request->publish_date && $request->publish_time) {
                // изменение времени публикации
                $publish = $request->publish_date . ' ' . $request->publish_time;
                $date = Carbon::createFromFormat('Y-m-d H:i', $publish, 'Europe/Kiev')
                    ->setTimezone('UTC')
                    ->toDateTimeString();
                if ($news->published_at != $date) {
                    $news->published_at = $date;
                    $news->published_by = $request->user()->id;
                }
            }

        }

        if(strpos($request->text, 'article__video-wrap') !== FALSE) {
            $news->is_video = 1;
        } else {
            $news->is_video = 0;
        }

        if ($request->meta_title == $news->name) {
            $news->meta_title = NULL;
        }

        if (!$request->meta_description) {
            $news->meta_description = Str::limit(str_replace(array('"'), '',strip_tags($request['text'])), 160, '');
        }

        $news->updated_by = $request->user()->id;
        $news->save();

        $news->setTags($request);

        return response()->json($news);
    }

    /**
     * Delete specified News
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $news->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }

    /**
     * Image Upload
     *
     * @param  Request  $request
     * @bodyParam image required Файл картинки
     * @return Response
     */
    public function imageCreate(Request $request)
    {        
        $image = ImageHelper::create_image_from_post('news', $request, News::IMAGE_CONFIG);
        return response()->json([
            'status' => 'ok',
            'image'  => $image
        ]);
    }

    /**
     * Image Delete
     *
     * @param  Request  $request
     * @bodyParam image required Файл картинки
     * @return Response
     */
    public function imageDelete(Request $request)
    {        
        if (ImageHelper::remove_image('news/' . $request->image)) {
            return response()->json([
                'status'  => 'ok',
                'message' => __('http.removed')
            ]);
        }
    }

    /**
     * Youtube Image Upload
     *
     * @param  Request  $request
     * @bodyParam youtube_id required ID видео на Youtube
     * @return Response
     */
    public function youtubeCreate(Request $request)
    {        
        $this->validate($request, [
            'youtube_id' => 'required'
        ]);

        
        try {
            $url = 'https://img.youtube.com/vi/' . $request->youtube_id . '/maxresdefault.jpg';
            $image = ImageHelper::create_image_from_url('youtube', $url , News::IMAGE_CONFIG);
        } catch (\Throwable $th) {
            try {
                $url = 'https://img.youtube.com/vi/' . $request->youtube_id . '/hqdefault.jpg';
                $image = ImageHelper::create_image_from_url('youtube', $url , News::IMAGE_CONFIG);
            } catch (\Throwable $th) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Не найдена картинка видео на Youtube'
                ], 404);
            }
        }

        return response()->json([
            'status' => 'ok',
            'image'  => $image
        ]);
    }
}
