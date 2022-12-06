<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Term extends Model
{
    use HasFactory;

    protected $casts = [
        'meta' => 'json'
    ];

    // Relation To TermsMeta
    public function page(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'page');
    }

    // Relation To TermsMeta
    public function excerpt(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'excerpt');
    }

    // Relation To TermsMeta
    public function awesome_awaits_excerpt(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'awesome_awaits_excerpt');
    }

    // Relation To TermsMeta
    public function metaTag(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'metatag');
    }

    // Relation To TermsMeta
    public function metaDescription(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'metadescription');
    }



    // Relation To TermsMeta
    public function pageMeta(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'page');
    }

    public function description(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'description');
    }
    public function awesome_awaits_description(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'awesome_awaits_description');
    }

    public function postMeta(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'meta');
    }

    public function preview(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'preview');
    }

    public function support(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'support');
    }
    public function awesome_awaits_preview(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'awesome_awaits_preview');
    }

    public function icon(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'icon');
    }


    public function thumbnail(): HasOne
    {
        return $this->hasOne(TermMeta::class, 'term_id')->where('key', '=', 'thumbnail');
    }

    public function termMeta(): HasOne
    {
        return $this->hasOne(TermMeta::class);
    }

    public function meta(): HasOne
    {
        return $this->hasOne(TermMeta::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'termcategories');
    }

    public function categoriesWithOne(): HasOne
    {
        return $this->hasOne(TermCategory::class, 'term_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'termcategories')->where('type', '=', 'tag')->select('id', 'name', 'type', 'slug');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'termcategories')->where('key', '=', 'category');
    }

    public function blogCategory(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'termcategories')->where('type', '=', 'blog_category')->select('id', 'name', 'type', 'slug');
    }

    public function termCategories(): HasMany
    {
        return $this->hasMany(TermCategory::class);
    }

    public function termMetas(): HasMany
    {
        return $this->hasMany(TermMeta::class);
    }
}
