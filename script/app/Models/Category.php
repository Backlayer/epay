<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'json'
    ];

    protected $fillable = [
        'key',
        'value',
        'lang',
        'status'
    ];

    /**
     * Get an attribute from the model.
     * Override original function to get meta value dynamically
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->value)) {
            return $this->value[$key];
        }

        return $attribute;
    }

    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Term::class, 'termcategories');
    }
}
