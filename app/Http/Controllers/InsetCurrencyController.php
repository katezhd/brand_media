<?php

namespace App\Http\Controllers;

use App\Models\InsetCurrency;
use Illuminate\Http\Request;

/**
 * @group currency
 *
 * API для работы с курсом валют.
 */

class InsetCurrencyController extends Controller
{
    /**
     * List of currency
     *
     * @param  Request  $request
     * @return Response
     */

    public function index(Request $request)
    {
        $currency  = new InsetCurrency();
        $currencies = $currency->getAll($request);
        return response()->json($currencies);
    }
}
