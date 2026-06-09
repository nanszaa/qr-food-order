<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    
    public function run(): void
    {
        Menu::insert([

        [
            'category_id' => 2,
            'name' => 'Cappuccino',
            'description' => 'Kopi cappuccino hangat',
            'price' => 25000,
            'stock' => 100,
            'is_available' => true,
            'is_best_seller' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'category_id' => 2,
            'name' => 'Americano',
            'description' => 'Kopi americano',
            'price' => 20000,
            'stock' => 100,
            'is_available' => true,
            'is_best_seller' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'category_id' => 1,
            'name' => 'Nasi Goreng',
            'description' => 'Nasi goreng spesial',
            'price' => 30000,
            'stock' => 100,
            'is_available' => true,
            'is_best_seller' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'category_id' => 3,
            'name' => 'Kentang Goreng',
            'description' => 'Kentang goreng crispy',
            'price' => 18000,
            'stock' => 100,
            'is_available' => true,
            'is_best_seller' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ],

    ]);
    }
}
