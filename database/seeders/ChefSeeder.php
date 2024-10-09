<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chef::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Walter White',
                'position' => 'Master Chef',
                'description' => 'Chef 1 Description',
                'insta_link' => 'chef_1_insta_link',
                'linked_link' => 'chef_1_linked_link',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Sarah Jhonson',
                'position' => 'Patissier',
                'description' => 'Chef 2 Description',
                'insta_link' => 'chef_2_insta_link',
                'linked_link' => 'chef_2_linked_link',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'William Anderson',
                'position' => 'Cook',
                'description' => 'Chef 3 Description',
                'insta_link' => 'chef_3_insta_link',
                'linked_link' => 'chef_3_linked_link',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
