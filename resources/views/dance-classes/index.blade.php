@extends('layouts.app')
@section('title', 'Dance Classes')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="mb-0">Dance Classes</h2>
    <div class="d-flex gap-2">
        <form class="d-flex" method="GET">
            <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search class or style">
            <button class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('dance-classes.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Class</th><th>Style</th><th>Level</th><th>Instructor</th><th>Fee</th><th>Schedules</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->dance_style }}</td>
                    <td>{{ $class->level }}</td>
                    <td>{{ $class->instructor->full_name }}</td>
                    <td>₱{{ number_format($class->fee, 2) }}</td>
                    <td><span class="badge bg-primary">{{ $class->schedules_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('dance-classes.show', $class) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('dance-classes.edit', $class) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <x-delete-button :action="route('dance-classes.destroy', $class)" message="Delete this class? Its schedules and enrollments will also be deleted." />
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No dance classes found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $classes->links() }}</div>
@endsection
