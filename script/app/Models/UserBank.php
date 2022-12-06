<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'json'
    ];

    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
