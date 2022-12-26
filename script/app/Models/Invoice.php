<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Helpers\HasPayment;

class Invoice extends Model
{
    use HasFactory;
    use HasPayment;

    protected $guarded = ['id'];

    protected $casts = [
        'fields' => 'json',
        'data' => 'json',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getIsPaidAttribute()
    {
        return $this->checkIsPaid((object) $this->attributes);
    }

    public function getIsConfirmedAttribute()
    {
        return $this->checkConfirmed((object) $this->attributes);
    }

    public function getPaymentStatusAttribute()
    {
        return $this->paymentStatus($this->attributes['status_paid']);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $donation) {
            $donation->uuid = Str::uuid()->toString();
        });
    }
}
