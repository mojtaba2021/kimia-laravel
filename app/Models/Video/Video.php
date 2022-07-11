<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory,
        SoftDeletes,
        VideoRelationships,
        VideoModifiers;

    protected $table = 'videos';

}
