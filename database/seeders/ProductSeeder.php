<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert(
            [
                [
                    'category_id' => 1,
                    'supplier_id' => 1,
                    'name'        => 'Bamboo Cutting Board',
                    'description' => 'Sustainably sourced bamboo chopping board.',
                    'price'       => 18.95,
                    'stock'       => 20,
                    'image'       => 'products/bamboo-cutting-board.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 1,
                    'supplier_id' => 2,
                    'name'        => 'Reusable Silicone Food Bag',
                    'description' => 'Leak-proof alternative to single-use plastics.',
                    'price'       => 11.50,
                    'stock'       => 40,
                    'image'       => 'products/food-bag.png',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 2,
                    'supplier_id' => 2,
                    'name'        => 'Solar LED Lantern',
                    'description' => 'Charges by day, lights your evenings off-grid.',
                    'price'       => 24.90,
                    'stock'       => 15,
                    'image'       => 'products/lantern.png',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 2,
                    'supplier_id' => 3,
                    'name'        => 'Rechargeable AA Battery Pack',
                    'description' => '4-pack Ni-MH cells plus USB charger.',
                    'price'       => 17.80,
                    'stock'       => 35,
                    'image'       => 'products/battery.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 3,
                    'supplier_id' => 1,
                    'name'        => 'Laundry Detergent Strips (32 wash)',
                    'description' => 'Ultra-light zero-waste alternative to liquid soap.',
                    'price'       => 12.25,
                    'stock'       => 50,
                    'image'       => 'products/laundry-detergent-strips.png',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 3,
                    'supplier_id' => 3,
                    'name'        => 'Glass Spray Bottle 500 ml',
                    'description' => 'Refillable amber glass bottle with mist nozzle.',
                    'price'       => 6.95,
                    'stock'       => 60,
                    'image'       => 'products/bottle.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 4,
                    'supplier_id' => 1,
                    'name'        => 'Recycled-Plastic Planter Pot (25 cm)',
                    'description' => 'Weather-proof, made from 100 % post-consumer plastic.',
                    'price'       => 9.99,
                    'stock'       => 25,
                    'image'       => 'products/pot.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 4,
                    'supplier_id' => 2,
                    'name'        => 'Metal Garden Tools Set',
                    'description' => 'Rust-resistant trowel, fork & transplanter.',
                    'price'       => 29.50,
                    'stock'       => 12,
                    'image'       => 'products/tools.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 5,
                    'supplier_id' => 3,
                    'name'        => 'Bamboo Toothbrush (3-pack)',
                    'description' => 'Biodegradable handle, soft plant-based bristles.',
                    'price'       => 8.75,
                    'stock'       => 45,
                    'image'       => 'products/toothbrush.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 5,
                    'supplier_id' => 1,
                    'name'        => 'Solid Shampoo Bar – Citrus',
                    'description' => 'Sulphate-free, lasts up to 80 washes.',
                    'price'       => 7.60,
                    'stock'       => 30,
                    'image'       => 'products/shampoo.jpg',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 6,
                    'supplier_id' => 2,
                    'name'        => 'Organic Cotton Swaddle Blanket',
                    'description' => 'GOTS-certified, breathable muslin cloth.',
                    'price'       => 19.20,
                    'stock'       => 22,
                    'image'       => 'products/blanket.png',
                    'created_at'  => now(),
                ],
                [
                    'category_id' => 6,
                    'supplier_id' => 3,
                    'name'        => 'Wooden Stacking Toy',
                    'description' => 'Non-toxic paints on FSC beech wood.',
                    'price'       => 14.40,
                    'stock'       => 18,
                    'image'       => 'products/toy.png',
                    'created_at'  => now(),
                ],
            ]
        );
    }
}
