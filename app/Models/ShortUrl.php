<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrl extends Model
{
    protected $fillable = [
        'user_id', 'long_url', 'short_url', 'visit_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
