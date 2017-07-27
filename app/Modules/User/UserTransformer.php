<?php
namespace App\Modules\User;

use App\Support\Model;
use App\Support\Transformer;

class UserTransformer extends Transformer
{

    /**
     * Transform item
     *
     * @param Model $item
     *
     * @return mixed
     */
    public function make($item)
    {
        return [
            'id'   => $item->id,
            'name' => $item->login,
        ];
    }
}
