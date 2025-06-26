<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                ['name' => 'Kitchen & Dining',   'created_at' => now()],
                ['name' => 'Home Energy',        'created_at' => now()],
                ['name' => 'Cleaning & Laundry', 'created_at' => now()],
                ['name' => 'Garden & Outdoor',   'created_at' => now()],
                ['name' => 'Personal Care',      'created_at' => now()],
                ['name' => 'Kids & Baby',        'created_at' => now()],
            ]
        );
    }
}
