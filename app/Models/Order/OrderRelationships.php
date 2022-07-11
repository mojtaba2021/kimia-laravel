<?php

namespace App\Models\Order;

use App\Models\Course\Course;
use App\Models\User\User;

trait OrderRelationships
{
    public function orderable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class,'orderable_id');
    }
}
