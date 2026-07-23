<?php

namespace App\Models;

use App\Traits\NotGuarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalta extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function Kaltaable()
    {
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute()
    {
        $target = $this->kaltaable;

        if (!$target) {
            return $this->url;
        }

        return $target->long_url ?? $target->name ?? $this->url;
    }
}
