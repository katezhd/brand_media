<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class InsetCurrency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inset_currencies';

    public $timestamps = false;

    public function getAll(Request $request)
    {
        $items = InsetCurrency::query()->select('inset_currencies.*')->orderBy('id', 'asc')->get();

        return $items;
    }
}
