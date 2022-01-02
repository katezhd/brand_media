<?php

namespace App\Http\Controllers;

use App\Models\InsetStat;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @group inset_stats
 *
 * API для работы со статистикой по репостам инфо-блоков.
 */

class InsetStatController extends Controller
{
    
    /**
     * List of inset_stats
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam type string Тип инфо-блока (horoscope, joke, quote)
     * @queryParam social string Социальная сеть (facebook, telegram)
     * @queryParam from string Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @queryParam till string Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @return Response
     */

    public function index(Request $request)
    {
        $inset_stat  = new InsetStat();
        $inset_stats = $inset_stat->getAll($request);
        return response()->json($inset_stats);
    }

    /**
     * Get specified inset_stats
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $inset_stats = InsetStat::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if($inset_stats->type) {
            $inset_stats[$inset_stats->type] = true;
        }

        return response()->json($inset_stats);
    }

    /**
     * Update inset_stats
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam type string required Тип инфо-блока (joke, quote, horoscope)
     * @bodyParam social string Социальная сеть (facebook, telegram)
     * @bodyParam inset_id integer ID инфо-блока
     * @return Response
     */
    public function create(Request $request)
    {        
        $inset_stats = new InsetStat($request->all());
        $inset_stats->save();
    }

    /**
     * List of data for charts
     *
     * @param  Request  $request
     * @queryParam type string Тип инфо-блока (horoscope, joke, quote)
     * @queryParam social string Социальная сеть (facebook, telegram)
     * @queryParam from string Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @queryParam till string Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
     * @return Response
     */

    public function charts(Request $request)
    {
        $inset_stat  = new InsetStat();
        $inset_stats = $inset_stat->getCharts($request);
        return response()->json($inset_stats);
    }
}
