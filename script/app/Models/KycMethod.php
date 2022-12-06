<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KycMethod extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'fields' => 'json'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('kyc_request_id');
    }
}
