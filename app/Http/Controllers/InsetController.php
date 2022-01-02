<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Inset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @group insets
 *
 * API для работы с разделителями.
 */

class InsetController extends Controller
{
    /**
     * List of insets
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
        $inset  = new Inset();
        $insets = $inset->getAll($request);
        return response()->json($insets);
    }

    /**
     * Create insets
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam position integer required Позиция в списке разделителей
     * @bodyParam type string required Тип разделителя (custom, random, videos, categories)
     * @bodyParam data string optional Массив данных для некоторых типов разделителя (ключи: category_id, left_id, right_id)
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function create(Request $request)
    {        
        
        $this->validate($request, Inset::getValidationRules());

        $max = Inset::max('position');

        $inset = new Inset($request->all());

        if ($request->status == 1) {
            $inset->published_at = Carbon::now()->toDateTimeString();
        } else {
            $inset->published_at = NULL;
        }

        $inset->position = $max + 1;

        $inset->save();

        return response()->json($inset);
    }

    /**
     * Get specified insets
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $inset = Inset::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if($inset->type) {
            $inset[$inset->type] = true;
        }

        return response()->json($inset);
    }

    /**
     * Update insets
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam position integer required Позиция в списке разделителей
     * @bodyParam type string required Тип разделителя (custom, random, videos, categories)
     * @bodyParam data string optional Массив данных для некоторых типов разделителя (ключи: category_id, left_id, right_id)
     * @bodyParam status integer Статус отображения (1-отображается, 0-скрыто)
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        try {
            $inset = Inset::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if(!$request->publishing) {
            $this->validate($request, Inset::getValidationRules($id));
        }

        $inset->fill($request->all());

        if ($inset->isDirty('type')) {
            if($request->type == 'custom') {
                $inset->data = [
                    'category_id' => NULL,
                    'left_id' => $request->data['left_id'],
                    'right_id' => $request->data['right_id'],
                ];
            }

            if($request->type == 'categories') {
                $inset->data = [
                    'category_id' => $request->data['category_id'],
                    'left_id' => NULL,
                    'right_id' => NULL,
                ];
            }

            if($request->type == 'videos' || $request->type == 'random') {
                $inset->data = [
                    'category_id' => NULL,
                    'left_id' => NULL,
                    'right_id' => NULL,
                ];
            }

            $inset->save();
        }

        if ($request->status == 1 && !$inset->published_at) {
            $inset->published_at = Carbon::now()->toDateTimeString();
        }

        if (($request->status === 0 || $request->status === '0') && $inset->published_at) {
            $inset->published_at = null;
        }

        $inset->save();

        return response()->json($inset);
    }

    /**
     * Delete specified insets
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $inset = Inset::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $inset->delete();

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
        $image = ImageHelper::create_image_from_base64('social', $request->image, [
            'width'  => 2048,
            'height' => 2048,
            'crop'   => false
        ]);
        return response()->json([
            'status' => 'ok',
            'image'  => $image
        ]);
    }

}
