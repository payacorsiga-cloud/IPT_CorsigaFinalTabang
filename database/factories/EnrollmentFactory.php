<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id'  => Student::inRandomOrder()->value('id') ?? Student::factory(),
            'schedule_id' => Schedule::inRandomOrder()->value('id') ?? Schedule::factory(),
            'enrolled_on' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'status'      => fake()->randomElement(['Active', 'Active', 'Active', 'Completed', 'Cancelled']),
        ];
    }
}
