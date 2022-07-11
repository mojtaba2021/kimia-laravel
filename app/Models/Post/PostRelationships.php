<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use App\Models\Image\Image;
use App\Models\User\User;

trait PostRelationships
{
    protected $cascadeDeletes = ['images', 'comments'];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
