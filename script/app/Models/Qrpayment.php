<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Helpers\HasPayment;

class Qrpayment extends Model
{
    use HasFactory;
    use HasPayment;

    protected $guarded = ['id'];

    protected $casts = [
        'fields' => 'json',
        'data' => 'json',
    ];

    public function seller(): BelongsTo
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
        return $this->paymentStatus($this->status_paid ?? '0');
    }

    public static function boot()
    {
        parent::boot();
        /*static::creating(function (self $model) {
            $model->id = self::max('id') + 1;
            $model->invoice_no = str_pad($model->id, 7, '0', STR_PAD_LEFT);
        });*/
    }
}
