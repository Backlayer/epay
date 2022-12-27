<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Clue\StreamFilter\fun;
use App\Helpers\HasPayment;

class SingleChargeOrder extends Model
{
    use HasFactory;
    use HasPayment;

    protected $table = 'singlechargeorders';

    protected $guarded = ['id'];

    protected $casts = [
        'fields' => 'json',
        'data' => 'json',
    ];

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function singleCharge(): BelongsTo
    {
        return $this->belongsTo(SingleCharge::class, 'singlecharge_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function getIsPaidAttribute()
    {
        return $this->checkIsPaid((object) $this->attributes);
    }

    public function getPaymentStatusAttribute()
    {
        return $this->paymentStatus($this->status_paid ?? '0');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->id = self::max('id') + 1;
            $model->invoice_no = str_pad($model->id, 7, '0', STR_PAD_LEFT);
        });
    }
}
