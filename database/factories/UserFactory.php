<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phone = $this->faker->unique(false, 5)->e164PhoneNumber();
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->unique(false, 5)->safeEmail(),
            'phone' => $phone,
            'password' => Hash::make($phone),
            'latitude' => $this->faker->latitude(3, 4),
            'longitude' => $this->faker->longitude(11, 12),
            'points' => $this->faker->randomNumber(5),
            'city_id' => rand(1, 5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
