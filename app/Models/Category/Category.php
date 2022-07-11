<?php

namespace App\Models\Category;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Category extends Model
{
    use HasFactory,
        SoftDeletes,
        CategoryRelationships,
        CategoryModifiers,
        Sluggable,
        CascadesDeletes;

    protected $table = 'categories';

}
