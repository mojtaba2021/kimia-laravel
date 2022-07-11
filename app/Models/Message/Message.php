<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory,
        SoftDeletes,
        MessageRelationships,
        MessageModifiers;

    protected $table = 'messages';
}
