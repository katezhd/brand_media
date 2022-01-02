<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Module;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @group Activity Log
 *
 * API для работы с историей действий пользователя в админке
 * Будет использоваться в админ панели сервиса
 */

class ActivityLogController extends Controller
{
    /**
     * List of activities
     *
     * @param  Request  $request
     * @queryParam page Номер страницы с результатами выдачи
     * @queryParam sort Поле для сортировки. По-умолчанию 'id\|desc'
     * @queryParam search Строка, которая должна содержаться в результатах выдачи
     * @queryParam subject_id ID записи
     * @queryParam subject_type Название раздела
     * @queryParam description Тип действия
     * @queryParam causer_id Кто делал
     * @queryParam from Дата начала интервала результатов выдачи (в формате 'DD-MM-YYYY HH:mm:ss')
     * @queryParam till Дата окончания интервала результатов выдачи (в формате 'DD-MM-YYYY HH:mm:ss')
     * @return Response
     */

    public function index(Request $request)
    {
        $activity = new ActivityLog();

        $activities = $activity->getAll($request);

        $modules = collect(['modules' => Module::with('parent')->get()]);

        return response()->json($modules->merge($activities));
    }

    /**
     * Get specified activity
     *
     * @param  Request  $request
     * @param  string  $id 
     * @return Response
     */

    public function show($id)
    {
        try {
            $activity = ActivityLog::with('causer','subject')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message}' => 'Not found.'
            ], 404);
        }

        $properties = [];
        if ($activity->properties->has('attributes')) {
            foreach ($activity->properties['attributes'] as $key => $value) {
                $properties[$key] = [
                    'key' => $key,
                    'name' => __($key),
                    'new'  => $value,
                    'new_text'  => null,
                    'old'  => null,
                    'old_text'  => null,
                ];
            }
            if ($activity->properties->has('old')) {
                foreach ($activity->properties['old'] as $key => $value) {
                    $properties[$key]['old'] = $value;
                }
            }
        }

        if ($activity->description == 'created') {
            $activity->created = true;
        }

        if ($activity->description == 'updated') {
            $activity->updated = true;
        }

        if ($activity->description == 'deleted') {
            $activity->deleted = true;
        }

        $activity->properties = array_values($properties);

        $activity->properties = $activity->getPropertiesTexts();

        return response()->json($activity);
    }

}
