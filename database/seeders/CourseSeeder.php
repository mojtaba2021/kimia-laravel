<?php

namespace Database\Seeders;

use App\Models\Course\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::factory()->count(20)->create();
    }
}
