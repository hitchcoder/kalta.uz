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
     * Human-readable label for this Kalta, regardless of the underlying
     * kaltaable type (Short, File, Bio).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->kaltaable?->long_url ?? $this->kaltaable?->name ?? $this->url;
    }
}
