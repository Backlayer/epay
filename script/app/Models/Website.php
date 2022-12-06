<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'mode',
        'message',
        'merchant_name',
        'token'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(WebOrder::class);
    }

    public function testOrders(): HasMany
    {
        return $this->hasMany(WebTestOrder::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $website){
            $website->token = \Str::random(32);
        });
    }
}
