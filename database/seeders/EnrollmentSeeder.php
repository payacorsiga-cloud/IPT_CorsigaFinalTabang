<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = Schedule::all();

        Student::all()->each(function ($student) use ($schedules) {
            // 1 to 3 different schedules per student (respects the unique student+schedule rule)
            $schedules->random(rand(1, 3))->each(function ($schedule) use ($student) {
                if ($schedule->seats_taken >= $schedule->capacity) {
                    return;
                }
                Enrollment::factory()->create([
                    'student_id'  => $student->id,
                    'schedule_id' => $schedule->id,
                ]);
            });
        });
    }
}
