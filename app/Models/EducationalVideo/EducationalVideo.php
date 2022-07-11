<?php

namespace App\Models\EducationalVideo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalVideo extends Model
{
    use HasFactory,
        SoftDeletes,
        EducationalVideoModifiers,
        EducationalVideoRelationships;

    protected $table = 'educational_videos';
}
