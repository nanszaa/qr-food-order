<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
  
    public function run(): void
    {
        Table::insert([
        [
            'table_number' => 'A01',
            'qr_token' => Str::uuid(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'table_number' => 'A02',
            'qr_token' => Str::uuid(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'table_number' => 'A03',
            'qr_token' => Str::uuid(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'table_number' => 'B01',
            'qr_token' => Str::uuid(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'table_number' => 'B02',
            'qr_token' => Str::uuid(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
