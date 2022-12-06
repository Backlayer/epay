<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Clue\StreamFilter\fun;

class SingleChargeOrder extends Model
{
    use HasFactory;

    protected $table = 'singlechargeorders';

    protected $guarded = ['id'];

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

    public static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->id = self::max('id') + 1;
            $model->invoice_no = str_pad($model->id, 7, '0', STR_PAD_LEFT);
        });
    }
}
