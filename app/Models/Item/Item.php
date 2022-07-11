<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Item extends Model
{
    use HasFactory,
        SoftDeletes,
        ItemModifiers,
        ItemRelationships,
        CascadesDeletes;

    protected $table = 'items';
}
