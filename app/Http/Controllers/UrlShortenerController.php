<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Models\UrlShortener;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function shortenUrl(UrlShortenerRequest $request)
    {
        $url = UrlShortener::create([
            'user_id' => auth()->id(),
            'original_url' => $request->input('original_url'),
            'short_url' => $this->generateUniqueShortUrl(),
        ]);

        if(!$url) {
            return 'not created!';
        }

        return view('dashboard', compact('url'));
    }

    private function generateUniqueShortUrl(): string
    {
        $isUnique = false;
        $attempts = 0;

        while (!$isUnique && $attempts < 3) {
            $hash = Str::random(6);
            $isUnique = !UrlShortener::where('short_url', $hash)->exists();
            $attempts++;
        }

        if (!$isUnique) {
            $hash = Str::random(6) . '_' . now()->timestamp;
        }

        return config('app.url') . '/' . $hash;
    }

}
