<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class UserPlan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'features' => 'json'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function subscribers(): HasMany
    {
        return $this->hasMany(UserPlanSubscriber::class);
    }

    public function active(): HasMany
    {
        return $this->hasMany(UserPlanSubscriber::class)->where('expire_at', '>=', today());
    }

    public function expired(): HasMany
    {
        return $this->hasMany(UserPlanSubscriber::class)->where('expire_at', '<', today());
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $userPlan){
            $userPlan->uuid = Str::uuid()->toString();
        });
    }
}
