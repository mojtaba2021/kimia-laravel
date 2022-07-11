<?php

namespace App\Models\EducationalVideo;

trait EducationalVideoModifiers
{

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

}
