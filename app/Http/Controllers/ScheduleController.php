<?php

namespace App\Http\Controllers;

use App\Models\DanceClass;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    private function rules(): array
    {
        return [
            'dance_class_id' => ['required', 'integer', 'exists:dance_classes,id'],
            'day_of_week'    => ['required', Rule::in(self::DAYS)],
            'start_time'     => ['required', 'date_format:H:i'],
            'end_time'       => ['required', 'date_format:H:i', 'after:start_time'],
            'room'           => ['required', 'string', 'max:100'],
            'capacity'       => ['required', 'integer', 'min:1', 'max:200'],
        ];
    }

    private function formData(Schedule $schedule): array
    {
        return [
            'schedule' => $schedule,
            'classes'  => DanceClass::orderBy('name')->pluck('name', 'id'),
            'days'     => array_combine(self::DAYS, self::DAYS),
        ];
    }

    public function index(Request $request)
    {
        $schedules = Schedule::with('danceClass.instructor')->withCount('enrollments')
            ->when($request->day, fn ($q, $day) => $q->where('day_of_week', $day))
            ->orderByRaw("FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')")
            ->orderBy('start_time')
            ->paginate(10)->withQueryString();

        return view('schedules.index', ['schedules' => $schedules, 'days' => self::DAYS]);
    }

    public function create()
    {
        return view('schedules.create', $this->formData(new Schedule));
    }

    public function store(Request $request)
    {
        Schedule::create($request->validate($this->rules()));

        return redirect()->route('schedules.index')->with('success', 'Schedule added successfully.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load('danceClass.instructor', 'enrollments.student');

        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', $this->formData($schedule));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate($this->rules());

        // Capacity cannot drop below the seats already taken
        if ($data['capacity'] < $schedule->seats_taken) {
            return back()->withInput()->withErrors([
                'capacity' => "Capacity cannot be lower than the {$schedule->seats_taken} students already enrolled.",
            ]);
        }

        $schedule->update($data);

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        // Enrollments for this schedule are removed by cascade
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule and its enrollments were deleted.');
    }
}
