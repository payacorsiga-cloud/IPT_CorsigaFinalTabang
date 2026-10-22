<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DanceClassFactory extends Factory
{
    public function definition(): array
    {
        $style = fake()->randomElement(['Ballet', 'Hip-hop', 'Salsa', 'Contemporary', 'Jazz', 'Ballroom', 'Folk Dance']);
        $level = fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']);

        return [
            'instructor_id' => Instructor::inRandomOrder()->value('id') ?? Instructor::factory(),
            'name'          => "$style - $level",
            'dance_style'   => $style,
            'level'         => $level,
            'fee'           => fake()->randomElement([500, 600, 800, 1000, 1200, 1500]),
            'description'   => fake()->sentence(12),
        ];
    }
}
