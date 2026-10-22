<?php

namespace Database\Seeders;

use App\Models\DanceClass;
use App\Models\Instructor;
use Illuminate\Database\Seeder;

class DanceClassSeeder extends Seeder
{
    public function run(): void
    {
        // Two classes per instructor so every FK points to a real instructor
        Instructor::all()->each(function ($instructor) {
            DanceClass::factory()->count(2)->create(['instructor_id' => $instructor->id]);
        });
    }
}
