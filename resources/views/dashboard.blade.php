@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row g-3 mb-4">
    @php
        $cards = [
            ['Students', $counts['students'], 'bi-people', 'students.index', 'primary'],
            ['Instructors', $counts['instructors'], 'bi-person-badge', 'instructors.index', 'success'],
            ['Dance Classes', $counts['classes'], 'bi-music-note-list', 'dance-classes.index', 'warning'],
            ['Schedules', $counts['schedules'], 'bi-calendar-week', 'schedules.index', 'info'],
            ['Enrollments', $counts['enrollments'], 'bi-clipboard-check', 'enrollments.index', 'danger'],
        ];
    @endphp
    @foreach ($cards as [$title, $count, $icon, $route, $color])
        <div class="col-6 col-md-4 col-lg">
            <a href="{{ route($route) }}" class="text-decoration-none">
                <div class="card stat-card h-100 text-center">
                    <div class="card-body">
                        <i class="bi {{ $icon }} fs-2 text-{{ $color }}"></i>
                        <div class="display-6">{{ $count }}</div>
                        <div class="text-muted">{{ $title }}</div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between">
                <strong>Recent Enrollments</strong>
                <a href="{{ route('enrollments.create') }}" class="btn btn-sm btn-primary">+ New</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Student</th><th>Class</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse ($recentEnrollments as $e)
                        <tr>
                            <td>{{ $e->student->full_name }}</td>
                            <td>{{ $e->schedule->danceClass->name }}</td>
                            <td><span class="badge bg-{{ $e->status === 'Active' ? 'success' : ($e->status === 'Completed' ? 'secondary' : 'danger') }}">{{ $e->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">No enrollments yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-white"><strong>Classes with the Most Schedules</strong></div>
            <ul class="list-group list-group-flush">
                @forelse ($popularClasses as $class)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $class->name }} <small class="text-muted">({{ $class->instructor->full_name }})</small></span>
                        <span class="badge bg-primary rounded-pill">{{ $class->schedules_count }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No classes yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
