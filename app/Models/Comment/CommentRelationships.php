<?php

namespace App\Models\Comment;


use App\Models\User\User;

trait CommentRelationships
{
    public function commentable()
    {
        return $this->morphTo();
    }
//    TODO delete comment's parent
    public function children()
    {
        return $this->hasMany(Comment::class,  'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
