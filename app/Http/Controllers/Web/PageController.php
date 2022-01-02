<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use Illuminate\Http\Request;

/**
 * @group Pages
 *
 * API для работы со статическимим страницами для фронта 
 */

class PageController extends Controller
{

    /**
     * Get specified page by its uri
     *
     * @param  Request  $request
     * @param  string  $uri
     * @return Response
     */
    public function show(Request $request, $uri)
    {
        $page = Page::where('uri', $uri)
            ->whereNotNull('published_at')
            ->first();

        if (!$page) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($page);
    }
}
