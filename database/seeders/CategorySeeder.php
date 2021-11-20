<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Mandatory Spend', 'description' => 'Mandatory for life', 'color' => '#00BB18', 'creator_id' => 1, 'is_active' => '1'],
            ['name' => 'Mandatory Spend Tier 2', 'description' => 'Mandatory for life tier 2', 'color' => '#A4B81E', 'creator_id' => 1, 'is_active' => '1']
        ]);
    }
}
