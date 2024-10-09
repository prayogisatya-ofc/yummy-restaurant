<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'uuid' => Str::uuid(),
                'title' => 'Starters',
                'slug' => 'starters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Breakfast',
                'slug' => 'breakfast',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Lunch',
                'slug' => 'lunch',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Dinner',
                'slug' => 'dinner',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
