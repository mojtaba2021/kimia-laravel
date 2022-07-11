<?php

namespace App\Models\Comment;

use App\Models\User\User;

trait CommentModifiers
{
    public function getUserIdAttribute($user_id)
    {
        $user = User::findOrFail($user_id);
        return $user->firstname . ' ' . $user->lastname;
    }

}
