<form action="{{ $enrollment->exists ? route('enrollments.update', $enrollment) : route('enrollments.store') }}" method="POST" novalidate>
    @csrf
    @if ($enrollment->exists) @method('PUT') @endif
    <div class="row">
        <div class="col-md-6"><x-select name="student_id" label="Student" :options="$students" :value="$enrollment->student_id" /></div>
        <div class="col-md-6"><x-select name="schedule_id" label="Class Schedule" :options="$schedules" :value="$enrollment->schedule_id" /></div>
        <div class="col-md-6"><x-input name="enrolled_on" type="date" label="Enrollment Date" :value="optional($enrollment->enrolled_on)->format('Y-m-d')" /></div>
        <div class="col-md-6"><x-select name="status" label="Status" :options="$statuses" :value="$enrollment->status" /></div>
    </div>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary">{{ $enrollment->exists ? 'Update' : 'Save' }} Enrollment</button>
</form>
