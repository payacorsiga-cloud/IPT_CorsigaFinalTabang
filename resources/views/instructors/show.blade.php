@extends('layouts.app')
@section('title', $instructor->full_name)
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>{{ $instructor->full_name }}</h2>
    <div>
        <a href="{{ route('instructors.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('instructors.edit', $instructor) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
<div class="card mb-3"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $instructor->email }}</dd>
        <dt class="col-sm-3">Phone</dt><dd class="col-sm-9">{{ $instructor->phone ?? '—' }}</dd>
        <dt class="col-sm-3">Specialty</dt><dd class="col-sm-9">{{ $instructor->specialty }}</dd>
    </dl>
</div></div>
<div class="card">
    <div class="card-header bg-white"><strong>Classes Taught</strong></div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Class</th><th>Style</th><th>Level</th><th>Schedules</th></tr></thead>
            <tbody>
            @forelse ($instructor->danceClasses as $class)
                <tr>
                    <td><a href="{{ route('dance-classes.show', $class) }}">{{ $class->name }}</a></td>
                    <td>{{ $class->dance_style }}</td><td>{{ $class->level }}</td>
                    <td>{{ $class->schedules->count() }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No classes assigned.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
