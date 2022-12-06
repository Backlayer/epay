<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStorefront extends Model
{
    use HasFactory;

    public $table = 'product_storefront';

    public function store()
    {
        return $this->belongsTo(Storefront::class, 'storefront_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
