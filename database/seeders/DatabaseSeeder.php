<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Order matters: parents first, children after. */
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            InstructorSeeder::class,
            DanceClassSeeder::class,
            ScheduleSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
