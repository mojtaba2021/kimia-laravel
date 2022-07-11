<?php

namespace App\Models\Video;

trait VideoRelationships
{
    public function videoable()
    {
        return $this->morphTo();
    }

}
