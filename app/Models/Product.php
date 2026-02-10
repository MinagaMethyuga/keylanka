<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'category',
        'title',
        'price',
        'brand',
        'stock',
        'description',
        'image',
    ];

    /**
     * Get all images associated with the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the primary image for the product, if any.
     */
    public function primaryImage()
    {
        return $this->images()->where('is_primary', true)->first();
    }

    /**
     * Get the display image path (primary image or legacy single image).
     */
    public function getDisplayImageAttribute(): ?string
    {
        $primary = $this->images()->where('is_primary', true)->first();
        if ($primary) {
            return $primary->path;
        }
        $first = $this->images()->first();
        if ($first) {
            return $first->path;
        }
        return $this->attributes['image'] ?? null;
    }
}
