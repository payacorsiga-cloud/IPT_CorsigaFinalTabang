@extends('layouts.app')
@section('title', 'Enrollment Details')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Enrollment #{{ $enrollment->id }}</h2>
    <div>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
<div class="card"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Student</dt>
        <dd class="col-sm-9"><a href="{{ route('students.show', $enrollment->student) }}">{{ $enrollment->student->full_name }}</a></dd>
        <dt class="col-sm-3">Class</dt>
        <dd class="col-sm-9"><a href="{{ route('dance-classes.show', $enrollment->schedule->danceClass) }}">{{ $enrollment->schedule->danceClass->name }}</a></dd>
        <dt class="col-sm-3">Instructor</dt><dd class="col-sm-9">{{ $enrollment->schedule->danceClass->instructor->full_name }}</dd>
        <dt class="col-sm-3">Schedule</dt><dd class="col-sm-9">{{ $enrollment->schedule->day_of_week }}, {{ $enrollment->schedule->time_range }} ({{ $enrollment->schedule->room }})</dd>
        <dt class="col-sm-3">Enrolled On</dt><dd class="col-sm-9">{{ $enrollment->enrolled_on->format('F d, Y') }}</dd>
        <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $enrollment->status }}</dd>
    </dl>
</div></div>
@endsection
