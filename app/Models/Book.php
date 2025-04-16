<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "long_description",
        "gender",
        "price",
        "age_range",
        "page_count",
        "materials",
        "dimensions",
        "manufacturing_time",
    ];

    public function images(): HasMany
    {
        return $this->hasMany(BookImage::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(BookVideo::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
