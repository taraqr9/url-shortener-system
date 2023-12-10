<?php

namespace App\Services;

use App\Models\UrlShortener;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function generateUniqueShortUrl(): string
    {
        $isUnique = false;
        $attempts = 0;

        while (! $isUnique && $attempts < 3) {
            $hash = Str::random(6);
            $isUnique = ! UrlShortener::where('short_url', $hash)->exists();
            $attempts++;
        }

        if (! $isUnique) {
            $hash = Str::random(6).'_'.now()->timestamp;
        }

        return $hash;
    }
}
