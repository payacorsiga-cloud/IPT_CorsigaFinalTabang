@extends('layouts.app')
@section('title', 'Enrollments')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="mb-0">Enrollments</h2>
    <div class="d-flex gap-2">
        <form class="d-flex" method="GET">
            <select name="status" class="form-select me-2" onchange="this.form.submit()">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Enroll</a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Student</th><th>Class</th><th>Schedule</th><th>Enrolled On</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($enrollments as $e)
                <tr>
                    <td>{{ $e->student->full_name }}</td>
                    <td>{{ $e->schedule->danceClass->name }}</td>
                    <td>{{ $e->schedule->day_of_week }} {{ $e->schedule->time_range }}</td>
                    <td>{{ $e->enrolled_on->format('M d, Y') }}</td>
                    <td><span class="badge bg-{{ $e->status === 'Active' ? 'success' : ($e->status === 'Completed' ? 'secondary' : 'danger') }}">{{ $e->status }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('enrollments.show', $e) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('enrollments.edit', $e) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <x-delete-button :action="route('enrollments.destroy', $e)" message="Delete this enrollment?" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No enrollments found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $enrollments->links() }}</div>
@endsection
