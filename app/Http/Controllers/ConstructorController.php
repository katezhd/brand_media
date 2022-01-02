<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

/**
 * @group constructor
 *
 * API для работы с конструктором новостей.
 */

class ConstructorController extends Controller
{
    
    /**
     * List of News Constructor
     *
     * @param  Request  $request
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam status string Статус отображения (возможные значения visible, hidden)
     * @queryParam main string Запрос для получения новостей для конструктора новостей
     * @return Response
     */

    public function index(Request $request)
    {
        $constructor  = new News();
        $constructors = $constructor->getPromo($request);
        return response()->json($constructors);
    }


    /**
     * Update News Constructor
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam pages string optional Массив страниц с массивом новостей
     * @return Response
     */
    public function update(Request $request)
    {    
        if($request->pages) {
            $pages = $request->pages;
            News::whereNotNull('position')->update(['position' => null]);
            for ($i = 0; $i < count($pages); $i++) { 
                $page = $pages[$i];
                for ($j = 1; $j <= count($page); $j++) { 
                    if(!empty($page[$j])) {
                        News::where('id', (int)$page[$j])->update(['position' => $i + 1 . '.' . $j ]);
                    } 
                }
            }
            return response()->json([
                'status'  => 'ok',
                'message' => __('Успешно сохранено')
            ], 200);
        }
    }


}
