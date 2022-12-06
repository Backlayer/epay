<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPlanSubscriber extends Model
{
    use HasFactory;

    protected $casts = [
        'expire_at' => 'datetime'
    ];

    protected $guarded = ['id'];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(UserPlan::class, 'user_plan_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
