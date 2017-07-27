<?php
namespace App\Modules\Category;

use App\Support\Transformer;

class CategoryTransformer extends Transformer
{
    /**
     * Transform item
     *
     * @param Category $item
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
