<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'json',
        'fields' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(KycMethod::class, 'kyc_method_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model){
            $user = User::whereRole('admin')->first();

//            $user->notify(new KYCRequestNotification($model));
            // TODO:: Send Notification to Website Admin
        });
    }
}
