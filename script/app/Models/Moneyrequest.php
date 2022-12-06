<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moneyrequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'amount',
        'charge',
        'status',
        'sender_id',
        'receiver_id',
        'request_currency_id',
        'approved_currency_id',
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function sender_currency()
    {
        return $this->belongsTo(Currency::class, 'request_currency_id');
    }
}
