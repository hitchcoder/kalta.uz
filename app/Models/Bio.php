<?php

namespace App\Models;

use App\Traits\Kaltaable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    protected $guarded = [];

    use HasFactory, Kaltaable;
}