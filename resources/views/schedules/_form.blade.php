<form action="{{ $schedule->exists ? route('schedules.update', $schedule) : route('schedules.store') }}" method="POST" novalidate>
    @csrf
    @if ($schedule->exists) @method('PUT') @endif
    <div class="row">
        <div class="col-md-6"><x-select name="dance_class_id" label="Dance Class" :options="$classes" :value="$schedule->dance_class_id" /></div>
        <div class="col-md-6"><x-select name="day_of_week" label="Day of the Week" :options="$days" :value="$schedule->day_of_week" /></div>
        <div class="col-md-3"><x-input name="start_time" type="time" label="Start Time" :value="substr($schedule->start_time ?? '', 0, 5)" /></div>
        <div class="col-md-3"><x-input name="end_time" type="time" label="End Time" :value="substr($schedule->end_time ?? '', 0, 5)" /></div>
        <div class="col-md-3"><x-input name="room" label="Room" :value="$schedule->room" /></div>
        <div class="col-md-3"><x-input name="capacity" type="number" min="1" label="Capacity" :value="$schedule->capacity ?? 15" /></div>
    </div>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary">{{ $schedule->exists ? 'Update' : 'Save' }} Schedule</button>
</form>
