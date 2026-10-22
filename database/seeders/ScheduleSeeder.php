<?php

namespace Database\Seeders;

use App\Models\DanceClass;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DanceClass::all()->each(function ($class) {
            Schedule::factory()->count(2)->create(['dance_class_id' => $class->id]);
        });
    }
}
