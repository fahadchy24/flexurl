<?php

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{url}', function ($url) {
    $short_url = ShortUrl::where('short_url', $url)->firstOrFail();
    if ($short_url) {
        return redirect()->to(url($short_url->long_url));
    }
    return redirect()->to(url('/'));

})->name('short-urls.goto');
