<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Models\UrlShortener;
use App\Services\ShortUrlService;
use Illuminate\Http\JsonResponse;

class UrlShortenerController extends Controller
{
    private $shortUrlService;

    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    public function shortenUrl(UrlShortenerRequest $request): JsonResponse
    {
        $url = UrlShortener::create([
            'original_url' => $request->input('original_url'),
            'short_url' => $this->shortUrlService->generateUniqueShortUrl(),
        ]);

        if (! $url) {
            return response()->json(['error' => 'Short failed to create!'], 402);
        }

        return response()->json(['short_url' => config('app.url').'/url/'.$url->short_url], 201);
    }
}
