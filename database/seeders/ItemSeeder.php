<?php

namespace Database\Seeders;

use App\Models\Item\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::factory()->count(500)->create();

    }
}
