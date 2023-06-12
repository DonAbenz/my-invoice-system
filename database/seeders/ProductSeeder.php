<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Sanitas Black Garlic',
            'Lavender Essential Oil',
            'Cinnamon Essential Oil',
            'Eucalyptus Essential Oil',
            'Lemon Essential Oil',
        ];
        foreach ($products as $name) {
            Product::create([
                'name' => $name,
                'cost' => rand(40, 50),
                'price' => rand(60, 100),
            ]);
        }
    }
}
