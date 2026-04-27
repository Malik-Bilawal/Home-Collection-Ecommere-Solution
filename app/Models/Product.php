<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'cut_price', 'rating', 'sku', 
        'category_id', 'is_active', 'stock', 'is_top_selling'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'offer_price' => 'decimal:2',
    ];

    protected $appends = ['discount_percentage', 'final_price', 'in_stock'];

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class)->where('is_active', true);
    }

    public function allSizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function defaultImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_default', true);
    }

    public function colorImages(): HasMany
    {
        return $this->hasMany(ProductImage::class)->whereNotNull('color_id');
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class)->where('is_active', true);
    }

    public function allColors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true);
    }

    public function allVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function getDiscountPercentageAttribute(): int
    {
        if ($this->offer_price && $this->price > 0) {
            return round((($this->price - $this->offer_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getFinalPriceAttribute()
    {
        return $this->offer_price ?? $this->price;
    }

    public function getInStockAttribute(): bool
    {
        return $this->stock > 0 || $this->variants()->where('stock', '>', 0)->exists();
    }

    public function getTotalStockAttribute(): int
    {
        if ($this->variants()->exists()) {
            return $this->variants()->sum('stock');
        }
        return $this->stock ?? 0;
    }

    public function currentUserHasPurchased(): bool
    {
        if (!auth()->check()) return false;
        return \App\Models\Order::where('user_id', auth()->id())
            ->whereIn('status', ['delivered', 'completed'])
            ->whereHas('items', fn($q) => $q->where('product_id', $this->id))
            ->exists();
    }

    public function currentUserHasReviewed(): bool
    {
        if (!auth()->check()) return false;
        return $this->reviews()->where('user_id', auth()->id())->exists();
    }
}