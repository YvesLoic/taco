<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'src' => $this->faker->imageUrl(),
            'car_id' => rand(1, 25),
        ];
    }
}
