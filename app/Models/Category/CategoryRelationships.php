<?php

namespace App\Models\Category;

use App\Models\Course\Course;
use App\Models\Post\Post;

trait CategoryRelationships
{
    protected $cascadeDeletes = ['posts', 'courses'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

//    public function children()
//    {
//        return $this->hasMany(Category::class, 'id', 'parent_id');
//    }


    public function courses()
    {
        return $this->morphedByMany(Course::class, 'categorizable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

//    public function posts()
//    {
//        return $this->morphedByMany('App\Post', 'categorizable');
//    }
}
