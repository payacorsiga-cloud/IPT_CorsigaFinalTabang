<?php

namespace App\Http\Controllers;

use App\Models\DanceClass;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Schedule;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'students'    => Student::count(),
            'instructors' => Instructor::count(),
            'classes'     => DanceClass::count(),
            'schedules'   => Schedule::count(),
            'enrollments' => Enrollment::count(),
        ];

        $recentEnrollments = Enrollment::with('student', 'schedule.danceClass')->latest()->take(6)->get();
        $popularClasses = DanceClass::with('instructor')
            ->withCount(['schedules'])
            ->orderByDesc('schedules_count')->take(5)->get();

        return view('dashboard', compact('counts', 'recentEnrollments', 'popularClasses'));
    }
}
