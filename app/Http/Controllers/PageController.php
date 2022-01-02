<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Page;
use Carbon\Carbon;
use Emuravjev\Mdash\Typograph;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Pages
 *
 * API для работы со статическимим страницами 
 */

class PageController extends Controller
{
    /**
     * List of pages
     *
     * @authenticated
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam uri string Путь, по которому должна открываться страница в приложении
     * @return Response
     */

    public function index(Request $request)
    {
        $page  = new Page();
        $pages = $page->getAll($request);
        return response()->json($pages);
    }


    /**
     * Create a page
     *
     * @authenticated
     * @param  Request  $request
     * @bodyParam name string required Название страницы
     * @bodyParam text string Описание приложения
     * @bodyParam image optional Картинка в base64
     * @bodyParam meta_title string Содержимое тега title
     * @bodyParam meta_description string Содержимое тега meta name="description"
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate($request, Page::getValidationRules());
            
        $page = new Page($request->all());

        if ($request->image) 
        {
            $page->image = ImageHelper::create_image_from_base64('pages', $request->image, Page::IMAGE_CONFIG);
        }

        if ($request->status == 1) {
            $page->published_at = Carbon::now()->toDateTimeString();
        } else {
            $page->published_at = NULL;
        }

        // типографирование
        $typograph = new Typograph();
        
        if ($request->use_typograph) {
            $typograph->set_text($request->name);
            $page->name = html_entity_decode(strip_tags($typograph->apply()));
            
            $typograph->set_text($request->text);
            $page->text = $typograph->apply();
        }

        if ($request->name) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Page::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $page->uri = $uri;
        }

        if ($request->meta_title == $page->name) {
            $page->meta_title = NULL;
        }

        if (!$request->meta_description) {
            $page->meta_description = Str::limit(str_replace(array('"'), '',strip_tags($request->text)), 160, '');
        }

        $page->save();

        return response()->json($page, 201);
    }

    /**
     * Get specified page
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($page);
    }

    /**
     * Update specified page
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string required Название страницы
     * @bodyParam text string Описание приложения
     * @bodyParam image optional Картинка в base64
     * @bodyParam meta_title string Содержимое тега title
     * @bodyParam meta_description string Содержимое тега meta name="description"
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        
        try {
            $page = Page::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }
        
        $this->validate($request, Page::getValidationRules($page->id));

        $page->fill($request->all());

        if ($request->image) {

            if ($page->image) {
                ImageHelper::remove_image('pages/' . $page->image);
                $page->image = null;
            }

            $page->image = ImageHelper::create_image_from_base64('pages', $request->image, Page::IMAGE_CONFIG);
        }

        if (!$request->image && $request->image_delete) {
            if ($page->image) {
                ImageHelper::remove_image('page/' . $page->image);
                $page->image = null;
            }
        }

        if ($page->wasChanged('name') && !$page->published_at) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Page::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $page->uri = $uri;
        }

        if ($request->status == 1 && !$page->published_at) {
            $page->published_at = Carbon::now()->toDateTimeString();
        }

        if (($request->status == 0) && $page->published_at) {
            $page->published_at = null;
        }

        // типографирование
        $typograph = new Typograph();
        
        if ($request->use_typograph) {
            $typograph->set_text($request->name);
            $page->name = html_entity_decode(strip_tags($typograph->apply()));
            
            $typograph->set_text($request->text);
            $page->text = $typograph->apply();
        }

        if ($request->meta_title == $page->name) {
            $page->meta_title = NULL;
        }
        
        $page->save();

        return response()->json($page);
    }

    /**
     * Delete specified page
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $page = Page::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $page->delete();

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
        $image = ImageHelper::create_image_from_post('pages', $request, Page::IMAGE_CONFIG);
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
        if (ImageHelper::remove_image('pages/' . $request->image)) {
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
