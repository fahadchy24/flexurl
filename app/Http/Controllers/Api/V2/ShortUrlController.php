<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Http\Resources\V2\ShortUrlCollection;
use App\Services\ShortUrlService;
use Illuminate\Http\JsonResponse;

class ShortUrlController extends Controller
{
    public function __construct(protected ShortUrlService $shortUrlService) {}

    public function store(ShortUrlRequest $request): JsonResponse
    {
        try {
            $this->shortUrlService->createShortUrl($request->validated());

            return response()->json([
                'message' => 'URL shortened successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function userUrls(): ShortUrlCollection
    {
        return new ShortUrlCollection($this->shortUrlService->getUserUrls());
    }
}
