<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortenLink extends Model
{
    use HasFactory;

    protected $table = 'shorten_link';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'long_url',
        'hash'
    ];
}
