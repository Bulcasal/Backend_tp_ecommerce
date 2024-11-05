<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Éclat d\'Énergie Améthyste',
                'price' => 10.99,
                'description' => 'Pierre naturelle d\'améthyste aux propriétés apaisantes',
                'stock' => 50,
                'category_id' => 1,
                'slug' => Str::slug('Éclat d\'Énergie Améthyste'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quartz Rose Harmonisant',
                'price' => 15.99,
                'description' => 'Quartz rose pour l\'amour et l\'harmonie',
                'stock' => 45,
                'category_id' => 2,
                'slug' => Str::slug('Quartz Rose Harmonisant'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Labradorite Mystique',
                'price' => 19.99,
                'description' => 'Pierre de protection et de transformation',
                'stock' => 30,
                'category_id' => 3,
                'slug' => Str::slug('Labradorite Mystique'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Obsidienne Protectrice',
                'price' => 12.99,
                'description' => 'Pierre noire de protection et d\'ancrage',
                'stock' => 40,
                'category_id' => 1,
                'slug' => Str::slug('Obsidienne Protectrice'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Citrine Abondance',
                'price' => 17.99,
                'description' => 'Pierre de prospérité et d\'abondance',
                'stock' => 35,
                'category_id' => 2,
                'slug' => Str::slug('Citrine Abondance'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Agate Équilibrante',
                'price' => 14.99,
                'description' => 'Pierre d\'équilibre et de stabilité',
                'stock' => 55,
                'category_id' => 2,
                'slug' => Str::slug('Agate Équilibrante'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jade Prospérité',
                'price' => 16.99,
                'description' => 'Pierre de chance et de prospérité',
                'stock' => 25,
                'category_id' => 3,
                'slug' => Str::slug('Jade Prospérité'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tourmaline Noire Protection',
                'price' => 21.99,
                'description' => 'Pierre puissante de protection',
                'stock' => 20,
                'category_id' => 1,
                'slug' => Str::slug('Tourmaline Noire Protection'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Malachite Transformation',
                'price' => 18.99,
                'description' => 'Pierre de transformation et de guérison',
                'stock' => 30,
                'category_id' => 3,
                'slug' => Str::slug('Malachite Transformation'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lapis Lazuli Sagesse',
                'price' => 23.99,
                'description' => 'Pierre de sagesse et de vérité',
                'stock' => 15,
                'category_id' => 2,
                'slug' => Str::slug('Lapis Lazuli Sagesse'),
                'image_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('products')->insert($products);
    }
}
