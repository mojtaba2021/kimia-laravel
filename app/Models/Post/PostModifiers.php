<?php

namespace App\Models\Post;

trait PostModifiers
{
//    public function getLinkAttribute()
//    {
//        return route('site.categories.show', ['slug' => slugify($this->slug)]);
//    }
    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

}
