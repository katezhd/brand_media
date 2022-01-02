<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Tags
 *
 * API для работы с тегами.
 */

class TagController extends Controller
{
    /**
     * List of Tags
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam status string Статус отображения (возможные значения visible, hidden)
     * @return Response
     */

    public function index(Request $request)
    {
        $tag  = new Tag();
        $tags = $tag->getAll($request);
        return response()->json($tags);
    }

    /**
     * Create Tags
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam name string required Название тега
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @bodyParam meta_title string required Тег title
     * @bodyParam meta_description string required Тег description
     * @bodyParam is_system integer Видимость тега (1-системный, 0-видимый)
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, Tag::getValidationRules());

        $tag = new Tag($request->all());

        if ($request->status == 1) {
            $tag->published_at = Carbon::now()->toDateTimeString();
        } else {
            $tag->published_at = NULL;
        }

        if ($request->name) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Tag::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $tag->uri = $uri;
        }

        if ($request->meta_title == $tag->name) {
            $tag->meta_title = NULL;
        }

        $tag->save();

        return response()->json($tag);
    }

    /**
     * Get specified Tags
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $tag = Tag::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($tag);
    }

    /**
     * Update Tags
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string required Название тега
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @bodyParam meta_title string required Тег title
     * @bodyParam meta_description string required Тег description
     * @bodyParam is_system integer Видимость тега (1-системный, 0-видимый)
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        try {
            $tag = Tag::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if(!$request->publishing) {
            $this->validate($request, Tag::getValidationRules($id));
        }

        $tag->fill($request->all());

        if ($request->status == 1 && !$tag->published_at) {
            $tag->published_at = Carbon::now()->toDateTimeString();
        }

        if (($request->status === 0 || $request->status === '0') && $tag->published_at) {
            $tag->published_at = null;
        }

        if ($tag->wasChanged('name') && $tag->published_at == null) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Tag::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $tag->uri = $uri;
        }

        if ($request->meta_title == $tag->name) {
            $tag->meta_title = NULL;
        }

        $tag->save();

        return response()->json($tag);
    }

    /**
     * Delete specified Tags
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $tag = Tag::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $tag->uri = NULL;
        $tag->save();

        $tag->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }
}
