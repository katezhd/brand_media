<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Categories
 *
 * API для работы с категориями.
 */

class CategoryController extends Controller
{
    
    /**
     * List of Categories
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
        $category  = new Category();
        $categories = $category->getAll($request);
        return response()->json($categories);
    }

    /**
     * Create Categories
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam name string required Название категории
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @bodyParam meta_title string required Тег title
     * @bodyParam meta_description string required Тег description
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, Category::getValidationRules());

        $category = new Category($request->all());

        if ($request->status == 1) {
            $category->published_at = Carbon::now()->toDateTimeString();
        } else {
            $category->published_at = NULL;
        }

        if ($request->name) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Category::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $category->uri = $uri;
        }

        if ($request->meta_title == $category->name) {
            $category->meta_title = NULL;
        }
        
        $category->save();

        return response()->json($category);
    }

    /**
     * Get specified Categories
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($category);
    }

    /**
     * Update Categories
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string required Название категории
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @bodyParam meta_title string required Тег title
     * @bodyParam meta_description string required Тег description
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if(!$request->publishing) {
            $this->validate($request, Category::getValidationRules($id));
        }

        $category->fill($request->all());

        if ($request->status == 1 && !$category->published_at) {
            $category->published_at = Carbon::now()->toDateTimeString();
        }

        if (($request->status === 0 || $request->status === '0') && $category->published_at) {
            $category->published_at = null;
        }

        if ($request->meta_title == $category->name) {
            $category->meta_title = NULL;
        }

        if ($category->wasChanged('name') && $category->published_at == null) {
            $uri = Str::slug($request->name, '-');
            $i = 1;
            while(Category::where('uri', $uri)->withTrashed()->count()) {
                $uri = $uri . '-' . $i++;
            }
            $category->uri = $uri;
        }

        $category->save();

        return response()->json($category);
    }

    /**
     * Delete specified Categories
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }
}
