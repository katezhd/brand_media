<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Emuravjev\Mdash\Typograph;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @group News Templates
 *
 * API для работы с шаблонами новостей.
 */

class TemplateController extends Controller
{
    
    /**
     * List of templates
     *
     * @param  Request  $request
     * @queryParam page integer Номер страницы с результатами выдачи
     * @queryParam sort string Поле для сортировки. По-умолчанию  'id|desc'
     * @queryParam search string Строка, которая должна содержаться в результатах выдачи
     * @return Response
     */

    public function index(Request $request)
    {
        $template  = new Template();
        $list = $template->getAll($request);

        return response()->json($list);
    }

    /**
     * Create template
     *
     * @authenticated
     * @param  Request  $request
     * 
     * @bodyParam name string required Название новости
     * @bodyParam text string optional Текст новости
     * @return Response
     */
    public function create(Request $request)
    {        
        $this->validate($request, Template::getValidationRules());

        $template = new Template($request->all());

        // типографирование
        $typograph = new Typograph();

        $typograph->set_text($request->text);
        $template->text = $typograph->apply();

        $typograph->set_text($request->name);
        $template->name = html_entity_decode(strip_tags($typograph->apply()));

        $template->save();

        return response()->json($template);
    }

    /**
     * Get specified Template
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $template = Template::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        return response()->json($template);
    }

    /**
     * Update Template
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @bodyParam name string required Название новости
     * @bodyParam text string optional Текст новости
     * @return Response
     */
    public function update(Request $request, $id)
    {        
        
        try {
            $template = Template::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $this->validate($request, Template::getValidationRules($id));

        $template->fill($request->all());

        // типографирование
        $typograph = new Typograph();

        $typograph->set_text($request->text);
        $template->text = $typograph->apply();

        $typograph->set_text($request->name);
        $template->name = html_entity_decode(strip_tags($typograph->apply()));
        
        $template->save();

        return response()->json($template);
    }

    /**
     * Delete specified Template
     *
     * @authenticated
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete($id)
    {
        try {
            $template = Template::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('http.not_found')
            ], 404);
        }

        $template->delete();

        return response()->json([
            'status'  => 'ok',
            'message' => __('http.removed')
        ]);
    }
}
