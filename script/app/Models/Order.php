<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipping_id',
        'seller_id',
        'gateway_id',
        'currency_id',
        'storefront_id',
        'invoice_no',
        'trx',
        'name',
        'email',
        'amount',
        'phone',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Order::max('id') + 1;
            $model->invoice_no = str_pad($model->id, 7, '0', STR_PAD_LEFT);
        });
    }

    public function orderitems()
    {
        return $this->hasMany(Orderitems::class);
    }

    public function storefront()
    {
        return $this->belongsTo(Storefront::class, 'storefront_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }
}
