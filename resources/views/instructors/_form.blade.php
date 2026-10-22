<form action="{{ $instructor->exists ? route('instructors.update', $instructor) : route('instructors.store') }}" method="POST" novalidate>
    @csrf
    @if ($instructor->exists) @method('PUT') @endif
    <div class="row">
        <div class="col-md-6"><x-input name="first_name" label="First Name" :value="$instructor->first_name" /></div>
        <div class="col-md-6"><x-input name="last_name" label="Last Name" :value="$instructor->last_name" /></div>
        <div class="col-md-6"><x-input name="email" type="email" label="Email" :value="$instructor->email" /></div>
        <div class="col-md-6"><x-input name="phone" label="Phone" :value="$instructor->phone" /></div>
        <div class="col-md-6"><x-input name="specialty" label="Specialty (e.g. Ballet)" :value="$instructor->specialty" /></div>
    </div>
    <a href="{{ route('instructors.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary">{{ $instructor->exists ? 'Update' : 'Save' }} Instructor</button>
</form>
