<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalta extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['display_name'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function kaltaable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute(): string
    {
        $kaltaable = $this->kaltaable;

        return $kaltaable?->long_url ?? $kaltaable?->name ?? $this->url;
    }
}
