<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'email'      => fake()->unique()->safeEmail(),
            'phone'      => fake()->numerify('09#########'),
            'birthdate'  => fake()->dateTimeBetween('-40 years', '-6 years')->format('Y-m-d'),
            'address'    => fake()->address(),
        ];
    }
}
