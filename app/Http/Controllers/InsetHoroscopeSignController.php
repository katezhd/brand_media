<?php

namespace App\Http\Controllers;

use App\Models\InsetHoroscopeSign;
use Illuminate\Http\Request;

/**
 * @group sign
 *
 * API для работы со знаками зодиака.
 */

class InsetHoroscopeSignController extends Controller
{
    /**
     * List of horoscope signs
     *
     * @param  Request  $request
     * @return Response
     */

    public function index(Request $request)
    {
        $sign  = new InsetHoroscopeSign();
        $signs = $sign->getAll($request);
        return response()->json($signs);
    }
}
