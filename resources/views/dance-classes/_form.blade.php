<form action="{{ $danceClass->exists ? route('dance-classes.update', $danceClass) : route('dance-classes.store') }}" method="POST" novalidate>
    @csrf
    @if ($danceClass->exists) @method('PUT') @endif
    <div class="row">
        <div class="col-md-6"><x-input name="name" label="Class Name" :value="$danceClass->name" /></div>
        <div class="col-md-6"><x-select name="instructor_id" label="Instructor" :options="$instructors" :value="$danceClass->instructor_id" /></div>
        <div class="col-md-4"><x-input name="dance_style" label="Dance Style" :value="$danceClass->dance_style" /></div>
        <div class="col-md-4"><x-select name="level" label="Level" :options="$levels" :value="$danceClass->level" /></div>
        <div class="col-md-4"><x-input name="fee" type="number" step="0.01" min="0" label="Fee (₱)" :value="$danceClass->fee" /></div>
        <div class="col-12"><x-textarea name="description" label="Description" :value="$danceClass->description" /></div>
    </div>
    <a href="{{ route('dance-classes.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary">{{ $danceClass->exists ? 'Update' : 'Save' }} Class</button>
</form>
