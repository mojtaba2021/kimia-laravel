<?php

namespace Database\Factories\EducationalVideo;

use Illuminate\Database\Eloquent\Factories\Factory;

class EducationalVideoFactory extends Factory
{

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'youtube_link' => "https://www.youtube.com/watch?v=G2ikFVP8csw",
            'aparat_link' => "https://www.aparat.com/v/uGFzx",
            'is_active' => 1,
        ];
    }
}
