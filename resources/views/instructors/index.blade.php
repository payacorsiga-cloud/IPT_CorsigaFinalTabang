@extends('layouts.app')
@section('title', 'Instructors')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="mb-0">Instructors</h2>
    <div class="d-flex gap-2">
        <form class="d-flex" method="GET">
            <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search name or specialty">
            <button class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('instructors.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add</a>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Name</th><th>Email</th><th>Specialty</th><th>Classes</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->full_name }}</td>
                    <td>{{ $instructor->email }}</td>
                    <td>{{ $instructor->specialty }}</td>
                    <td><span class="badge bg-primary">{{ $instructor->dance_classes_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('instructors.show', $instructor) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('instructors.edit', $instructor) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <x-delete-button :action="route('instructors.destroy', $instructor)" message="Delete this instructor?" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No instructors found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $instructors->links() }}</div>
@endsection
