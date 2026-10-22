@extends('layouts.app')
@section('title', 'Schedules')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="mb-0">Schedules</h2>
    <div class="d-flex gap-2">
        <form class="d-flex" method="GET">
            <select name="day" class="form-select me-2" onchange="this.form.submit()">
                <option value="">All days</option>
                @foreach ($days as $day)
                    <option value="{{ $day }}" @selected(request('day') === $day)>{{ $day }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Class</th><th>Instructor</th><th>Day</th><th>Time</th><th>Room</th><th>Seats</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($schedules as $s)
                <tr>
                    <td>{{ $s->danceClass->name }}</td>
                    <td>{{ $s->danceClass->instructor->full_name }}</td>
                    <td>{{ $s->day_of_week }}</td>
                    <td>{{ $s->time_range }}</td>
                    <td>{{ $s->room }}</td>
                    <td>{{ $s->seats_taken }} / {{ $s->capacity }}</td>
                    <td class="text-end">
                        <a href="{{ route('schedules.show', $s) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('schedules.edit', $s) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <x-delete-button :action="route('schedules.destroy', $s)" message="Delete this schedule? Its enrollments will also be deleted." />
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No schedules found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $schedules->links() }}</div>
@endsection
