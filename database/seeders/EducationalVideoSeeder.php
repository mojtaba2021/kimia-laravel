<?php

namespace Database\Seeders;

use App\Models\EducationalVideo\EducationalVideo;
use Illuminate\Database\Seeder;

class EducationalVideoSeeder extends Seeder
{
    public function run()
    {
        EducationalVideo::factory()->count(30)->create();
    }
}
