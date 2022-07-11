<?php

namespace App\Models\EducationalVideo;

use App\Models\Image\Image;

trait EducationalVideoRelationships
{
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
