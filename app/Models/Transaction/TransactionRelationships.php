<?php

namespace App\Models\Transaction;

use App\Models\User\User;

trait TransactionRelationships
{

//    public function categories()
//    {
//        return $this->morphToMany(Category::class, 'categorizable');
//    }
//
//    public function images()
//    {
//        return $this->morphOne(Image::class, 'imageable');
//    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
