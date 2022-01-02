<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

/**
 * @group news_stats
 *
 * API для работы со статистикой по новостям.
 */

class NewsStatController extends Controller
{
    /**
     * List of news_stats
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
        $news_stat  = new News();
        $news_stats = $news_stat->getAll($request);
        return response()->json($news_stats);
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
        $news_stat  = new News();
        $news_stats = $news_stat->getCharts($request);
        return response()->json($news_stats);
    }
}
