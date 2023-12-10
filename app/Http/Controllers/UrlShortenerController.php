<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Models\UrlShortener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UrlShortenerController extends Controller
{
    public function shortenUrl(UrlShortenerRequest $request): View|RedirectResponse
    {
        $url = UrlShortener::create([
            'user_id' => auth()->id() ?? null,
            'original_url' => $request->input('original_url'),
            'short_url' => $this->generateUniqueShortUrl(),
        ]);

        if (! $url) {
            return redirect()->back()->with('error', 'Failed to short url!');
        }

        if (! isset($url['user_id'])) {
            return view('dashboard', ['url' => $url])->with('success', 'Url shorten successfully!');
        }

        return redirect()->back()->with('success', 'Url shorten successfully!');

    }

    public function redirectToOriginalUrl($shortUrl): RedirectResponse
    {
        try {
            $url = UrlShortener::where('short_url', $shortUrl)->firstOrFail();

            $url->increment('click_count');

            return redirect($url->original_url);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Failed to redirect to the original URL.');
        }
    }

    private function generateUniqueShortUrl(): string
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
