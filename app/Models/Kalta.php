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

    /**
     * Human-readable label for this kalta, based on the underlying resource type.
     */
    public function getDisplayNameAttribute(): string
    {
        $kaltaable = $this->kaltaable;

        return $kaltaable->long_url
            ?? $kaltaable->name
            ?? $this->url;
    }
}
