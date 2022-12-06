<?php

namespace App\Models;

use App\Helpers\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SingleCharge extends Model
{
    use HasFactory, HasUid;

    protected $table = 'singlecharges';

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
        return $this->belongsTo(Currency::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(SingleChargeOrder::class, 'singlecharge_id');
    }

    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    }
}
