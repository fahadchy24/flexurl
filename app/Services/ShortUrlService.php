<?php

namespace App\Services;

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function createShortUrl(array $data)
    {
        $existingUrlForUser = ShortUrl::where('long_url', $data['long_url'])
            ->where('user_id', Auth::id())
            ->first();

        if (! $existingUrlForUser) {
            $new_url = ShortUrl::create([
                'user_id' => Auth::id(),
                'long_url' => $data['long_url'],
            ]);

            $short_url = Str::random(6);
            $new_url->update([
                'short_url' => $short_url,
            ]);
        }

        return $existingUrlForUser;
    }

    public function getUserUrls($perPage = 10)
    {
        return auth()->user()->links()->paginate($perPage);
    }
}
