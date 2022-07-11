<?php

namespace App\Models\Course;

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use App\Models\Image\Image;
use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Video\Video;

trait CourseRelationships
{
    protected $cascadeDeletes = ['images', 'videos', 'items', 'comments'];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

//TODO Edit videos to video
    public function videos()
    {
        return $this->morphOne(Video::class, 'videoable');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function orders()
    {
        return $this->morphOne(Order::class, 'orderable');
    }
}
