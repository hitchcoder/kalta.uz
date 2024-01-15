<?php

namespace App\Traits;

use App\Models\Link;

trait Linkable{
    public function link()
    {
        return $this->morphOne(Link::class, 'linkable');
    }
}