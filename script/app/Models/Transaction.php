<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Transaction::max('id') + 1;
            $model->invoice_no = str_pad($model->id, 7, '0', STR_PAD_LEFT);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function getSourceAttribute()
    {
        if ($this->source_data) {
            $sourceRelation = [
                'Invoice' => "App\Models\Invoice",
                'Qrpayment' => "App\Models\Qrpayment",
                'SingleChargeOrder' => "App\Models\SingleChargeOrder",
            ][$this->source_data];

            if ($this->source_id && $sourceRelation) {
                $data = $sourceRelation::whereId($this->source_id)->first();

                return (object) [
                    'id' => $this->source_id,
                    'type' => $this->source_data,
                    'file' => $data->invoice_file,
                ];
            }
        }

        return (object) [
            'id' => null,
            'type' => null,
            'file' => null,
        ];
    }

    protected function convertedAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['amount'] / $attributes['rate']
        )->shouldCache();
    }
}
