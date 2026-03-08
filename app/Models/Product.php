<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use App\Models\ProductImage;
use App\Models\Review;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }
}
