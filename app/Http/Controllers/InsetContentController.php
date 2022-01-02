<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\InsetContent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\SocialMediaHelper;

/**
 * @group inset_contents
 *
 * API для работы с инфо-блоками.
 */

class InsetContentController extends Controller
{
    
    /**
     * List of inset_contents
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @queryParam status string Статус отображения (возможные значения visible, hidden)
     * @return Response
     */

    public function index(Request $request)
    {
        $inset_content  = new InsetContent();
        $inset_contents = $inset_content->getAll($request);
        return response()->json($inset_contents);
    }

    /**
     * Create inset_contents
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam name string optional Имя автора в инфо-блоке 
     * @bodyParam text string optional Массив с текстом для инфо-блока (возможные ключи: quote, joke) 
     * @bodyParam video_code string optional Код Youtube видео
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, InsetContent::getValidationRules());

        $inset_content = new InsetContent($request->all());

        if($request->text) {
            foreach ($request->text as $key => $value) {
                if($key == $request->type) {
                    $inset_content->text = $value;
                }
            }
        }
        
        if($request->type == 'video') {
            $inset_content->image = $this->youtubeCreate($request->video_code);
            $inset_content->text = $this->youtubeTitle($request->video_code);
        } 
        
        $inset_content->save();

        if($inset_content->type != 'video') {
            try {
                SocialMediaHelper::generate_image($inset_content->type, $inset_content->type, $inset_content, $inset_content->id);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return response()->json($inset_content);
    }

    /**
     * Get specified inset_contents
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $inset_content = InsetContent::with('news')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        if($inset_content->type) {
            $inset_content[$inset_content->type] = true;
        }

        return response()->json($inset_content);
    }

    /**
     * Update inset_contents
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string optional Имя автора в инфо-блоке 
     * @bodyParam text string optional Массив с текстом для инфо-блока (возможные ключи: quote, joke) 
     * @bodyParam video_code string optional Код Youtube видео
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        try {
            $inset_content = InsetContent::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $this->validate($request, InsetContent::getValidationRules($id));

        $inset_content->fill($request->all());

        if($request->text) {
            foreach ($request->text as $key => $value) {
                if($key == $request->type) {
                    $inset_content->text = $value;
                }
            }
        }

        if($inset_content->isDirty('type')) {
            if($request->type == 'quote') {
                $inset_content->image = NULL;
                $inset_content->video_code = NULL;
            }
            if($request->type == 'joke') {
                $inset_content->name = NULL;
                $inset_content->image = NULL;
                $inset_content->video_code = NULL;
            }
            if($request->type == 'video') {
                $inset_content->name = NULL;
                $inset_content->text = NULL;
            }
            if($request->type == 'weather' || $request->type == 'currency' || $request->type == 'horoscope') {
                $inset_content->name = NULL;
                $inset_content->image = NULL;
                $inset_content->text = NULL;
                $inset_content->video_code = NULL;
            }
        }

        if($request->type == 'video') {
            $inset_content->image = $this->youtubeCreate($request->video_code);
            $inset_content->text = $this->youtubeTitle($request->video_code);
        }

        if(!empty($request->imported_at)) {
            $inset_content->imported_at = NULL;
        }

        $inset_content->save();

        if($inset_content->type != 'video') {
            try {
                SocialMediaHelper::generate_image($inset_content->type, $inset_content->type, $inset_content, $inset_content->id);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return response()->json($inset_content);
    }

    /**
     * Delete specified inset_contents
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $inset_content = InsetContent::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $inset_content->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }


    /**
     * Youtube Image Upload
     *
     * @param  Request  $request
     * @bodyParam youtube_id required ID видео на Youtube
     * @return Response
     */
    public function youtubeCreate($video_code)
    {        
        $url = 'https://img.youtube.com/vi/' . $video_code . '/0.jpg';
        $image = ImageHelper::create_image_from_url('youtube', $url , InsetContent::IMAGE_CONFIG);

        return $image;
    }

    /**
     * Youtube Get Title
     *
     * @param  Request  $request
     * @bodyParam youtube_id required ID видео на Youtube
     * @return Response
     */
    public function youtubeTitle($video_code)
    {        
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $video_code . '&key=AIzaSyBQKlrzGsd4daBNsqZJuyHm7ejIfXzJ5hk';
        
        $response = Http::get($url)->throw(function ($response, $e) { 
            $this->fail($e); 
        });

        if ($response->ok()) {
            $json = json_decode($response->getBody());
            $json = json_decode(json_encode($json), true);
            if($json['items'][0]['snippet']['title']) {
                return $json['items'][0]['snippet']['title'];
            } else {
                return null;
            }
        }
        return null;
    }


}
