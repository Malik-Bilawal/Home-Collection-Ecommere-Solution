<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ShoeStoreSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Sneakers', 'slug' => 'sneakers', 'status' => 1],
            ['name' => 'Formal Shoes', 'slug' => 'formal-shoes', 'status' => 1],
            ['name' => 'Sandals', 'slug' => 'sandals', 'status' => 1],
            ['name' => 'Loafers', 'slug' => 'loafers', 'status' => 1],
            ['name' => 'Boots', 'slug' => 'boots', 'status' => 1],
            ['name' => 'Slippers', 'slug' => 'slippers', 'status' => 1],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        $this->command->info('Created ' . count($categories) . ' categories');

        $colors = [
            ['name' => 'Black', 'hex_code' => '#000000'],
            ['name' => 'White', 'hex_code' => '#FFFFFF'],
            ['name' => 'Brown', 'hex_code' => '#8B4513'],
            ['name' => 'Navy', 'hex_code' => '#000080'],
            ['name' => 'Grey', 'hex_code' => '#808080'],
        ];

        $sizes = [
            ['name' => '38', 'display_name' => 'Size 38'],
            ['name' => '39', 'display_name' => 'Size 39'],
            ['name' => '40', 'display_name' => 'Size 40'],
            ['name' => '41', 'display_name' => 'Size 41'],
            ['name' => '42', 'display_name' => 'Size 42'],
            ['name' => '43', 'display_name' => 'Size 43'],
        ];

        $products = [
            [
                'name' => 'Premium Leather Sneakers',
                'description' => 'High-quality leather sneakers with comfort cushioning. Perfect for casual wear.',
                'price' => 8500,
                'cut_price' => 12000,
                'category' => 'Sneakers',
                'rating' => 4.5,
                'is_top_selling' => true,
            ],
            [
                'name' => 'Classic Formal Oxfords',
                'description' => 'Elegant formal shoes for business occasions. Genuine leather construction.',
                'price' => 12500,
                'cut_price' => 18000,
                'category' => 'Formal Shoes',
                'rating' => 4.8,
                'is_top_selling' => true,
            ],
            [
                'name' => 'Comfort Sandals',
                'description' => 'Lightweight summer sandals with adjustable straps. Premium quality.',
                'price' => 3500,
                'cut_price' => 5000,
                'category' => 'Sandals',
                'rating' => 4.3,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Casual Leather Loafers',
                'description' => 'Stylish loafers for office and casual wear. Soft leather interior.',
                'price' => 7500,
                'cut_price' => 10000,
                'category' => 'Loafers',
                'rating' => 4.6,
                'is_top_selling' => true,
            ],
            [
                'name' => 'Chelsea Boots',
                'description' => 'Classic Chelsea boots with elastic side panels. Premium leather.',
                'price' => 15000,
                'cut_price' => 22000,
                'category' => 'Boots',
                'rating' => 4.7,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Indoor Slippers',
                'description' => 'Comfortable indoor slippers with soft sole. Perfect for home.',
                'price' => 1500,
                'cut_price' => 2500,
                'category' => 'Slippers',
                'rating' => 4.2,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Running Sneakers',
                'description' => 'Lightweight running shoes with shock absorption. Sport style.',
                'price' => 9500,
                'cut_price' => 14000,
                'category' => 'Sneakers',
                'rating' => 4.4,
                'is_top_selling' => true,
            ],
            [
                'name' => 'Brogue Formal Shoes',
                'description' => 'Classic brogue detailing on premium leather. Traditional style.',
                'price' => 11000,
                'cut_price' => 16000,
                'category' => 'Formal Shoes',
                'rating' => 4.5,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Beach Sandals',
                'description' => 'Water-resistant beach sandals. Quick dry material.',
                'price' => 2500,
                'cut_price' => 4000,
                'category' => 'Sandals',
                'rating' => 4.1,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Driving Loafers',
                'description' => 'Flexible driving loafers. Soft leather sole.',
                'price' => 6500,
                'cut_price' => 9000,
                'category' => 'Loafers',
                'rating' => 4.4,
                'is_top_selling' => true,
            ],
            [
                'name' => 'Work Boots',
                'description' => 'Durable work boots with steel toe. Safety first.',
                'price' => 18000,
                'cut_price' => 25000,
                'category' => 'Boots',
                'rating' => 4.6,
                'is_top_selling' => false,
            ],
            [
                'name' => 'Luxury Hotel Slippers',
                'description' => 'Premium velvet slippers. For luxury hotels.',
                'price' => 2000,
                'cut_price' => 3500,
                'category' => 'Slippers',
                'rating' => 4.8,
                'is_top_selling' => true,
            ],
        ];

        foreach ($products as $productData) {
            $category = $productData['category'];
            unset($productData['category']);

            $categoryModel = Category::where('name', $category)->first();
            if (!$categoryModel) continue;

            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'cut_price' => $productData['cut_price'],
                'rating' => $productData['rating'],
                'category_id' => $categoryModel->id,
                'is_active' => true,
                'is_top_selling' => $productData['is_top_selling'],
                'sku' => 'FW-' . strtoupper(substr($category, 0, 3)) . '-' . rand(100, 999),
                'stock' => rand(10, 50),
            ]);

            foreach ($colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color['name'],
                    'hex_code' => $color['hex_code'],
                    'is_active' => true,
                ]);
            }

            foreach ($sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'name' => $size['name'],
                    'display_name' => $size['display_name'],
                    'is_active' => true,
                ]);
            }

            $stockPerSize = rand(5, 20);
            $productColors = $product->allColors()->get();
            $productSizes = $product->allSizes()->get();

            foreach ($productColors as $color) {
                foreach ($productSizes as $size) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                        'price' => $product->price,
                        'stock' => rand(0, $stockPerSize),
                        'is_active' => true,
                    ]);
                }
            }

            $imageUrls = [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800',
                'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=800',
                'https://images.unsplash.com/photo-1606107557195-0e29a4cb5c69?w=800',
                'https://images.unsplash.com/photo-1595950653106-6c9eb5ed3272?w=800',
            ];

            foreach ($imageUrls as $index => $url) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $url,
                    'is_default' => $index === 0,
                ]);
            }
        }

        $this->command->info('Created ' . count($products) . ' products with colors, sizes, and variants!');
    }
}