<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Option extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'json'
    ];

    protected $fillable = ['key', 'value', 'lang'];

    /**
     * Get an attribute from the model.
     * Override original function to get value dynamically
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->value ?? [])) {
            return $this->value[$key];
        }

        return $attribute;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            Cache::forget($model->key);
        });
    }
}
