<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "rate",
        "type",
        "status"
    ];

    public static function types()
    {
        return [
            "percentage",
            "fixed"
        ];
    }
}
