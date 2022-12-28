<?php

namespace App\Models;

use App\Helpers\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\HasPayment;

class SingleCharge extends Model
{
    use HasFactory, HasUid;
    use HasPayment;

    protected $table = 'singlecharges';

    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'json',
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

    public function lastOrder()
    {
        return $this->orders()?->latest()?->first();
    }

    public function getIsConfirmedAttribute()
    {
        return $this->checkConfirmed($this->lastOrder());
    }

    public function getIsPaidAttribute()
    {
        return $this->checkIsPaid($this->lastOrder());
    }

    public function getPaymentStatusAttribute()
    {
        return $this->paymentStatus($this->lastOrder()?->status_paid ?? '0');
    }

    /* public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    } */
}
