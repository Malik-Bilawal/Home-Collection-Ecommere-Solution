<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductColor extends Model
{
    protected $fillable = ['product_id', 'name', 'hex_code', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'color_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'color_id');
    }

    public function getImageAttribute(): ?string
    {
        $image = $this->images()->first();
        return $image ? asset('storage/' . $image->image_path) : null;
    }
}