<?php

namespace App\Models;

use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, Linkable;

    protected $guarded = [];
}
