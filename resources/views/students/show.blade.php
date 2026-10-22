@extends('layouts.app')
@section('title', $student->full_name)
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>{{ $student->full_name }}</h2>
    <div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
<div class="card mb-3"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $student->email }}</dd>
        <dt class="col-sm-3">Phone</dt><dd class="col-sm-9">{{ $student->phone ?? '—' }}</dd>
        <dt class="col-sm-3">Birthdate</dt><dd class="col-sm-9">{{ optional($student->birthdate)->format('F d, Y') ?? '—' }}</dd>
        <dt class="col-sm-3">Address</dt><dd class="col-sm-9">{{ $student->address ?? '—' }}</dd>
    </dl>
</div></div>
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between">
        <strong>Enrolled Classes</strong>
        <a href="{{ route('enrollments.create') }}" class="btn btn-sm btn-primary">+ Enroll</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Class</th><th>Instructor</th><th>Schedule</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($student->enrollments as $e)
                <tr>
                    <td>{{ $e->schedule->danceClass->name }}</td>
                    <td>{{ $e->schedule->danceClass->instructor->full_name }}</td>
                    <td>{{ $e->schedule->day_of_week }} {{ $e->schedule->time_range }}</td>
                    <td>{{ $e->status }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Not enrolled in any class yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
