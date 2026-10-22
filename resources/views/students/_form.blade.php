<form action="{{ $student->exists ? route('students.update', $student) : route('students.store') }}" method="POST" novalidate>
    @csrf
    @if ($student->exists) @method('PUT') @endif
    <div class="row">
        <div class="col-md-6"><x-input name="first_name" label="First Name" :value="$student->first_name" /></div>
        <div class="col-md-6"><x-input name="last_name" label="Last Name" :value="$student->last_name" /></div>
        <div class="col-md-6"><x-input name="email" type="email" label="Email" :value="$student->email" /></div>
        <div class="col-md-6"><x-input name="phone" label="Phone" :value="$student->phone" /></div>
        <div class="col-md-6"><x-input name="birthdate" type="date" label="Birthdate" :value="optional($student->birthdate)->format('Y-m-d')" /></div>
        <div class="col-md-6"><x-input name="address" label="Address" :value="$student->address" /></div>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary">{{ $student->exists ? 'Update' : 'Save' }} Student</button>
</form>
