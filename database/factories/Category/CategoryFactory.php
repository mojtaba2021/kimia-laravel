<?php

namespace Database\Factories\Category;

use App\Models\Category\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

    public function definition()
    {
//        $title = $this->faker->realTextBetween(5, 45);
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'parent_id' => 0,
            'type' => rand(1, 3),
        ];
    }

}
