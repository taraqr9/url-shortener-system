<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUrlShortenerRequest;
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

    public function edit(UrlShortener $url): View
    {
        return view('edit', compact('url'));
    }

    public function update(UrlShortener $url, UpdateUrlShortenerRequest $request): RedirectResponse
    {
        if (! $url->update($request->validated())) {
            return redirect()->back()->with('error', 'Url update failed!');
        }

        return redirect()->back()->with('success', 'Url updated successfully!');
    }

    public function delete(UrlShortener $url): RedirectResponse
    {
        if (! $url->delete()) {
            return redirect()->back()->with('error', 'Url delete failed!');
        }

        return redirect()->back()->with('success', 'Url deleted successfully');
    }

    public function redirectToOriginalUrl(UrlShortener $shortUrl): RedirectResponse
    {
        if(!$shortUrl->increment('click_count')) {
            return redirect()->back()->with('error', 'Failed to redirect to the original URL.');
        }

        return redirect($shortUrl->original_url);
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
