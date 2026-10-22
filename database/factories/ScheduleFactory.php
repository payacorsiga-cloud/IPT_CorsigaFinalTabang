<?php

namespace Database\Factories;

use App\Models\DanceClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->numberBetween(8, 18);

        return [
            'dance_class_id' => DanceClass::inRandomOrder()->value('id') ?? DanceClass::factory(),
            'day_of_week'    => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time'     => sprintf('%02d:00:00', $start),
            'end_time'       => sprintf('%02d:00:00', $start + 1),
            'room'           => fake()->randomElement(['Studio A', 'Studio B', 'Studio C', 'Main Hall']),
            'capacity'       => fake()->numberBetween(10, 20),
        ];
    }
}
