<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebTestOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $order){
            $order->uuid = \Str::uuid();
        });
    }
}
