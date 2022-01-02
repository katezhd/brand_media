<?php

namespace App\Http\Controllers;

use App\Models\InsetHoroscope;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @group horoscopes
 *
 * API для работы с гороскопами.
 */

class InsetHoroscopeController extends Controller
{
    /**
     * Get specified horoscope
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request)
    {
        try {
            $inset = InsetHoroscope::with('sign')->findOrFail($request->sign_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($inset);
    }
}
