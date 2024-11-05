<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bracelets Pierres Naturelles',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bracelets Chakras',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bracelets Apaisants',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
