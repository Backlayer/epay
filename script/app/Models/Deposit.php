<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "gateway_id",
        "trx",
        "amount",
        "total_amount",
        "currency_id",
        "status",
        "payment_status",
        "charge",
        "rate",
        "meta",
    ];

    protected $casts = [
        'meta' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    /**
     * Get an attribute from the model.
     * Override original function to get meta value dynamically
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    }
}
