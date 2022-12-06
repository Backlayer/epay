<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderitems extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'token',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->token = now()->timestamp.Str::random(30);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
