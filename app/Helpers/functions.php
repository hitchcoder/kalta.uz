<?php

use App\Models\Kalta;
use Illuminate\Support\Str;

function randomString(): string
{
    do {
        $randomString = Str::upper(Str::random(5));
    } while (Kalta::where('url', $randomString)->exists());

    return $randomString;
}