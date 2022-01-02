<?php

namespace App\Http\Controllers;

use App\Models\InsetContent;
use Illuminate\Http\Request;

/**
 * @group inset_contents
 *
 * API для работы с импортом цитат.
 */

class QuoteImportController extends Controller
{
    
    /**
     * List of inset_contents
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @return Response
     */

    public function index(Request $request)
    {
        $inset_content  = new InsetContent();
        $inset_contents = $inset_content->getAll($request, 'quote');
        return response()->json($inset_contents);
    }
}
