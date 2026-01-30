<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'offer_price', 'rating', 'sku', 
        'category_id', 'is_active',  'stock', 'is_top_selling',
        'weight', 'dimensions', 'materials', 'care_instructions'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'offer_price' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    protected $appends = ['discount_percentage', 'final_price', 'in_stock'];

    // Relationships
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function defaultImage(){
        return $this->hasOne(ProductImage::class)->where('is_default', 1);
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
// in App\Models\Product.php
public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'product_id'); // link to order_items table
}

    // Accessors
    public function getDiscountPercentageAttribute()
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

    public function getInStockAttribute()
    {
        return $this->stock > 0 || $this->sizes()->where('stock', '>', 0)->exists();
    }

    public function getMainImageAttribute()
    {
        $image = $this->images()->where('is_default', true)->first();
        if (!$image) {
            $image = $this->images()->first();
        }
        return $image ? asset('storage/' . $image->image_path) : asset('images/default-product.jpg');
    }

    public function getGalleryImagesAttribute()
    {
        return $this->images()->where('is_default', false)->get();
    }

    // Check if user has purchased this product
    public function currentUserHasPurchased()
    {
        if (!auth()->check()) return false;

        return \App\Models\Order::where('user_id', auth()->id())
            ->whereIn('status', ['delivered', 'completed'])
            ->whereHas('items', function ($query) {
                $query->where('product_id', $this->id);
            })
            ->exists();
    }


    
    // Check if user has reviewed this product
    public function currentUserHasReviewed()
    {
        if (!auth()->check()) return false;
        return $this->reviews()->where('user_id', auth()->id())->exists();
    }
}