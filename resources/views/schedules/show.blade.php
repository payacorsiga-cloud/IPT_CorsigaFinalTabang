@extends('layouts.app')
@section('title', 'Schedule Details')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>{{ $schedule->danceClass->name }}</h2>
    <div>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
<div class="card mb-3"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Instructor</dt><dd class="col-sm-9">{{ $schedule->danceClass->instructor->full_name }}</dd>
        <dt class="col-sm-3">When</dt><dd class="col-sm-9">{{ $schedule->day_of_week }}, {{ $schedule->time_range }}</dd>
        <dt class="col-sm-3">Room</dt><dd class="col-sm-9">{{ $schedule->room }}</dd>
        <dt class="col-sm-3">Seats</dt><dd class="col-sm-9">{{ $schedule->seats_taken }} / {{ $schedule->capacity }}</dd>
    </dl>
</div></div>
<div class="card">
    <div class="card-header bg-white"><strong>Enrolled Students</strong></div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Student</th><th>Enrolled On</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($schedule->enrollments as $e)
                <tr>
                    <td><a href="{{ route('students.show', $e->student) }}">{{ $e->student->full_name }}</a></td>
                    <td>{{ $e->enrolled_on->format('M d, Y') }}</td>
                    <td>{{ $e->status }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">No students enrolled.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
