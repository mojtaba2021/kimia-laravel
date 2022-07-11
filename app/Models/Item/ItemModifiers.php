<?php

namespace App\Models\Item;

use App\Enums\EItemIsFree;
use App\Enums\EItemType;

trait ItemModifiers
{
    public function getParentIdAttribute($parent_id)
    {
        if ($parent_id == EItemType::SEASON) {
            return "فصل";
        }
       return ($this->find($parent_id)->title);
    }

    public function getIsFreeAttribute($is_free)
    {
        if ($is_free == EItemIsFree::FREE) {
            return "رایگان";
        }elseif($is_free == EItemIsFree::PAID){
            return "غیر رایگان";
        }
        return '-';
    }
}
