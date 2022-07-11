<?php

namespace Database\Factories\Post;

use App\Models\Post\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    public function definition()
    {
//        $title = $this->faker->realTextBetween(5, 45);
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
//        $user = User::count() >= 20 ? User::inRandomOrder()->first()->id: User::factory();
//        $category = Category::count() >= 7 ? Category::inRandomOrder()->first()->id: Category::factory();


        return [
            'user_id' => 1,
            'title' => $title,
            'slug' =>  $slug,
            'description' => $this->faker->text(),
            'is_active' => 1,
        ];
    }

}
