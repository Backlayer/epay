<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx',
        'rate',
        'status',
        'amount',
        'charge',
        'user_id',
        'commant',
        'currency_id',
        'user_bank_id',
    ];

    public function userbank()
    {
        return $this->belongsTo(UserBank::class, 'user_bank_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
