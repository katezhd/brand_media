<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Reactions
 *
 * API для работы с реакциями.
 */

class ReactionController extends Controller
{
    /**
     * Create Reactions
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam token string required Название организации
     * @bodyParam action string required Действие (like, dislike)
     * @bodyParam news_id integer ID новости
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, Reaction::getValidationRules());
        $reaction = new Reaction($request->all());

        if($request->token) {
            if(Reaction::where('token', $request->token)
                        ->where('news_id', $request->news_id)
                        ->count()) 
            {
                return response()->json([
                    'status'  => 'error',
                    'message' => __('http.forbidden')
                ], 403);
            } 
        } else {
            $token = Str::random(32);
            $reaction->token = $token;
        }

        News::findOrFail($request->news_id)->increment($request->action, 1);

        $reaction->save();
        return response()->json($reaction);
    }
}
