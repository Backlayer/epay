<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationOrder extends Model
{
    use HasFactory;

    protected $table = 'donationorders';

    protected $guarded = ['id'];

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donor_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
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
