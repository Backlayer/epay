<?php

namespace App\Models;

use App\Helpers\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(DonationOrder::class, 'donation_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $donation){
            $donation->uuid = Str::uuid()->toString();
        });
    }
}
