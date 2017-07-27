<?php
namespace App\Modules\Genre;

use App\Support\Transformer;

class GenreTransformer extends Transformer
{
    /**
     * Transform item
     *
     * @param Genre $item
     *
     * @return mixed
     */
    public function make($item)
    {
        return [
            'id'       => $item->id,
            'name'     => $item->name,
            'apiValue' => $item->apiValue,
        ];
    }
}
