<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Authors
 *
 * API для работы с авторами.
 */

class AuthorController extends Controller
{
    
    /**
     * List of Authors
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
        $author  = new Author();
        $authors = $author->getAll($request);
        return response()->json($authors);
    }

    /**
     * Create Authors
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam firstname string required Имя
     * @bodyParam lastname string required Фамилия
     * @bodyParam meta_title string required Тег title
     * @bodyParam meta_description string required Тег description
     * @bodyParam image optional Картинка
     * @bodyParam image_delete optional Удаление картинки (1-удалить)
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, Author::getValidationRules());

        $author = new Author($request->all());

        if ($request->status == 1) {
            $author->published_at = Carbon::now()->toDateTimeString();
        } else {
            $author->published_at = NULL;
        }

        if ($request->meta_title == $author->firstname . ' ' . $request->lastname) {
            $author->meta_title = NULL;
        }
        
        if ($request->image) 
        {
            $author->image = ImageHelper::create_image_from_base64('authors', $request->image, Author::IMAGE_CONFIG);
        }

        if ($request->firstname && $request->lastname) {
            $uri = Str::slug($request->firstname . '-' . $request->lastname, '-');
            $i = 1;
            while(Author::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $author->uri = $uri;
        }

        $author->save();

        return response()->json($author);
    }

    /**
     * Get specified Authors
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $author = Author::with('news')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($author);
    }

    /**
     * Update Authors
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam firstname string required Имя
     * @bodyParam lastname string required Фамилия
     * @bodyParam meta_title string Тег title
     * @bodyParam meta_description string Тег description
     * @bodyParam image optional Картинка
     * @bodyParam image_delete optional Удаление картинки (1-удалить)
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if(!$request->publishing) {
            $this->validate($request, Author::getValidationRules($id));
        }

        $author->fill($request->all());

        if ($request->meta_title == $author->firstname . ' ' . $request->lastname) {
            $author->meta_title = NULL;
        }

        if ($request->image) {

            if ($author->image) {
                ImageHelper::remove_image('authors/' . $author->image);
                $author->image = null;
            }

            $author->image = ImageHelper::create_image_from_base64('authors', $request->image, Author::IMAGE_CONFIG);
        }

        if (!$request->image && $request->image_delete) {
            if ($author->image) {
                ImageHelper::remove_image('authors/' . $author->image);
                $author->image = null;
            }
        }

        if ($request->status == 1 && !$author->published_at) {
            $author->published_at = Carbon::now()->toDateTimeString();
        }

        if (($request->status === 0 || $request->status === '0') && $author->published_at) {
            $author->published_at = null;
        }

        $author->save();

        if ($author->wasChanged('firstname') || $author->wasChanged('lastname') && $author->published_at == null) {
            $uri = Str::slug($request->firstname . '-' . $request->lastname, '-');
            $i = 1;
            while(Author::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $author->uri = $uri;
        }

        $author->save();

        $author = Author::find($id);

        return response()->json($author);
    }

    /**
     * Delete specified Authors
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $author->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }
}
