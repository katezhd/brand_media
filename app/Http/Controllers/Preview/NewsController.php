<?php

namespace App\Http\Controllers\Preview;

use App\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Spatie\Activitylog\Contracts\Activity;


/**
 * @group News Preview
 *
 * API для работы с предпросмотром новости.
 */

class NewsController extends Controller
{
    /**
     * Get specified News
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $news = News::with(['author', 'category', 'tags'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $news->preview = true;
        
        return response()->json($news);
    }

}
