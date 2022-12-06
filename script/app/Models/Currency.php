<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "rate",
        "symbol",
        "position",
        "status",
        "is_default",
        "country_name"
    ];

    protected $castes = [
        "status" => 'bool',
        'is_default' => 'bool'
    ];

    public function gateways(): HasMany
    {
        return $this->hasMany(Gateway::class);
    }
}
