<?php

namespace Database\Factories\Item;

use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{

    public function definition()
    {
        return [
            'course_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->text(),
            'is_free' => rand(0, 1),
            'parent_id' => rand(0, 25),
            'sort' => rand(0, 10),
        ];
    }

}
