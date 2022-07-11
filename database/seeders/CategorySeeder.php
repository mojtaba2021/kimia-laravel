<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()->count(15)->create();
    }
}
