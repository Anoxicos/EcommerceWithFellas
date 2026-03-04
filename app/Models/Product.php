<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    /**
     * Relationships
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('approved', true);
    }

    /**
     * Accessors
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->approvedReviews()->avg('rating') ?? 0.0;
    }
}

