<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Support extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meta(): HasMany
    {
        return $this->hasMany(SupportMeta::class, 'support_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $support){
            $support->id=Support::max('id') + 1;
            $support->ticket_no=str_pad($support->id, 7,'0',STR_PAD_LEFT);
        });
    }
}
