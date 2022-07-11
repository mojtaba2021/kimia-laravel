<?php

namespace App\Models\Course;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Course extends Model
{
    use HasFactory,
        Sluggable,
        SoftDeletes,
        CourseRelationships,
        CourseModifiers,
        CascadesDeletes;

    protected $table = 'courses';
}
