<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'color' => $this->faker->colorName(),
            'gray_card' => $this->faker->macAddress(),
            'model' => $this->faker->domainName(),
            'registration_number' => $this->faker->creditCardNumber(),
            'type_id' => rand(1, 5),
            'user_id' => rand(1, 50),
        ];
    }
}
