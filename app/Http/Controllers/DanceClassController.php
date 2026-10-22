<?php

namespace App\Http\Controllers;

use App\Models\DanceClass;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DanceClassController extends Controller
{
    public const LEVELS = ['Beginner', 'Intermediate', 'Advanced'];

    private function rules(): array
    {
        return [
            'instructor_id' => ['required', 'integer', 'exists:instructors,id'],
            'name'          => ['required', 'string', 'max:150'],
            'dance_style'   => ['required', 'string', 'max:100'],
            'level'         => ['required', Rule::in(self::LEVELS)],
            'fee'           => ['required', 'numeric', 'min:0', 'max:999999'],
            'description'   => ['nullable', 'string', 'max:1000'],
        ];
    }

    private function formData(DanceClass $danceClass): array
    {
        return [
            'danceClass'  => $danceClass,
            'instructors' => Instructor::orderBy('last_name')->get()->pluck('full_name', 'id'),
            'levels'      => array_combine(self::LEVELS, self::LEVELS),
        ];
    }

    public function index(Request $request)
    {
        $classes = DanceClass::with('instructor')->withCount('schedules')
            ->when($request->q, function ($query, $search) {
                $query->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%$search%")
                      ->orWhere('dance_style', 'like', "%$search%");
                });
            })
            ->latest()->paginate(10)->withQueryString();

        return view('dance-classes.index', compact('classes'));
    }

    public function create()
    {
        return view('dance-classes.create', $this->formData(new DanceClass));
    }

    public function store(Request $request)
    {
        DanceClass::create($request->validate($this->rules()));

        return redirect()->route('dance-classes.index')->with('success', 'Dance class added successfully.');
    }

    public function show(DanceClass $dance_class)
    {
        $dance_class->load('instructor', 'schedules');

        return view('dance-classes.show', ['danceClass' => $dance_class]);
    }

    public function edit(DanceClass $dance_class)
    {
        return view('dance-classes.edit', $this->formData($dance_class));
    }

    public function update(Request $request, DanceClass $dance_class)
    {
        $dance_class->update($request->validate($this->rules()));

        return redirect()->route('dance-classes.index')->with('success', 'Dance class updated successfully.');
    }

    public function destroy(DanceClass $dance_class)
    {
        // Schedules and their enrollments are removed by cascade
        $dance_class->delete();

        return redirect()->route('dance-classes.index')->with('success', 'Dance class and its schedules were deleted.');
    }
}
