<?php

namespace App\Models;

use App\Traits\NotGuarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function displayName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->kaltaable?->long_url ?? $this->kaltaable?->name ?? $this->url,
        );
    }
}
