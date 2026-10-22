<?php

use App\Http\Controllers\DanceClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('students', StudentController::class);
Route::resource('instructors', InstructorController::class);
Route::resource('dance-classes', DanceClassController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('enrollments', EnrollmentController::class);
