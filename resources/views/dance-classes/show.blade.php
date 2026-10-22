@extends('layouts.app')
@section('title', $danceClass->name)
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>{{ $danceClass->name }}</h2>
    <div>
        <a href="{{ route('dance-classes.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('dance-classes.edit', $danceClass) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
<div class="card mb-3"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Instructor</dt>
        <dd class="col-sm-9"><a href="{{ route('instructors.show', $danceClass->instructor) }}">{{ $danceClass->instructor->full_name }}</a></dd>
        <dt class="col-sm-3">Style / Level</dt><dd class="col-sm-9">{{ $danceClass->dance_style }} / {{ $danceClass->level }}</dd>
        <dt class="col-sm-3">Fee</dt><dd class="col-sm-9">₱{{ number_format($danceClass->fee, 2) }}</dd>
        <dt class="col-sm-3">Description</dt><dd class="col-sm-9">{{ $danceClass->description ?? '—' }}</dd>
    </dl>
</div></div>
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between">
        <strong>Schedules</strong>
        <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-primary">+ Add Schedule</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Day</th><th>Time</th><th>Room</th><th>Seats</th></tr></thead>
            <tbody>
            @forelse ($danceClass->schedules as $s)
                <tr>
                    <td><a href="{{ route('schedules.show', $s) }}">{{ $s->day_of_week }}</a></td>
                    <td>{{ $s->time_range }}</td><td>{{ $s->room }}</td>
                    <td>{{ $s->seats_taken }} / {{ $s->capacity }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No schedules yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
