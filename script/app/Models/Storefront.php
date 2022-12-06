<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Storefront extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'status',
        'user_id',
        'note_status',
        'description',
        'product_type',
        'shipping_status',
    ];

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
