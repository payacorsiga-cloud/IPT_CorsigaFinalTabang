<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    private function rules(Request $request, ?Enrollment $enrollment = null): array
    {
        return [
            'student_id'  => ['required', 'integer', 'exists:students,id'],
            'schedule_id' => [
                'required', 'integer', 'exists:schedules,id',
                // a student can only be enrolled once in the same schedule
                Rule::unique('enrollments')
                    ->where(fn ($q) => $q->where('student_id', $request->student_id))
                    ->ignore($enrollment?->id),
            ],
            'enrolled_on' => ['required', 'date', 'before_or_equal:today'],
            'status'      => ['required', Rule::in(Enrollment::STATUSES)],
        ];
    }

    private function messages(): array
    {
        return ['schedule_id.unique' => 'This student is already enrolled in that schedule.'];
    }

    private function formData(Enrollment $enrollment): array
    {
        return [
            'enrollment' => $enrollment,
            'students'   => Student::orderBy('last_name')->get()->pluck('full_name', 'id'),
            'schedules'  => Schedule::with('danceClass')->get()->sortBy('label')->pluck('label', 'id'),
            'statuses'   => array_combine(Enrollment::STATUSES, Enrollment::STATUSES),
        ];
    }

    /** Returns an error message when the chosen schedule is already full. */
    private function fullError(array $data, ?Enrollment $enrollment = null): ?string
    {
        if ($data['status'] === 'Cancelled') {
            return null;
        }

        $schedule = Schedule::find($data['schedule_id']);
        $taken = $schedule->enrollments()
            ->where('status', '!=', 'Cancelled')
            ->when($enrollment, fn ($q) => $q->where('id', '!=', $enrollment->id))
            ->count();

        return $taken >= $schedule->capacity ? 'This schedule is already full.' : null;
    }

    public function index(Request $request)
    {
        $enrollments = Enrollment::with('student', 'schedule.danceClass')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest()->paginate(10)->withQueryString();

        return view('enrollments.index', ['enrollments' => $enrollments, 'statuses' => Enrollment::STATUSES]);
    }

    public function create()
    {
        return view('enrollments.create', $this->formData(new Enrollment(['enrolled_on' => now(), 'status' => 'Active'])));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules($request), $this->messages());

        if ($error = $this->fullError($data)) {
            return back()->withInput()->withErrors(['schedule_id' => $error]);
        }

        Enrollment::create($data);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment recorded successfully.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load('student', 'schedule.danceClass.instructor');

        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        return view('enrollments.edit', $this->formData($enrollment));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $data = $request->validate($this->rules($request, $enrollment), $this->messages());

        if ($error = $this->fullError($data, $enrollment)) {
            return back()->withInput()->withErrors(['schedule_id' => $error]);
        }

        $enrollment->update($data);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
