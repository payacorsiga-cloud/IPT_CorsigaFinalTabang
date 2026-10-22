@extends('layouts.app')
@section('title', 'Students')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="mb-0">Students</h2>
    <div class="d-flex gap-2">
        <form class="d-flex" method="GET">
            <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search name or email">
            <button class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Name</th><th>Email</th><th>Phone</th><th>Enrollments</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td><span class="badge bg-primary">{{ $student->enrollments_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <x-delete-button :action="route('students.destroy', $student)" message="Delete this student and all of their enrollments?" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No students found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $students->links() }}</div>
@endsection
