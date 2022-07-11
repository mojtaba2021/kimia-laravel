<?php

namespace App\Models\Post;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Post extends Model
{
    use HasFactory,
        SoftDeletes,
        PostRelationships,
        PostModifiers,
        Sluggable,
        CascadesDeletes;

    protected $table = 'posts';
}
