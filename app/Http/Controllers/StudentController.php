<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private function rules(?Student $student = null): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student?->id)],
            'phone'      => ['nullable', 'string', 'max:30'],
            'birthdate'  => ['nullable', 'date', 'before:today'],
            'address'    => ['nullable', 'string', 'max:255'],
        ];
    }

    public function index(Request $request)
    {
        $students = Student::withCount('enrollments')
            ->when($request->q, function ($query, $search) {
                $query->where(function ($w) use ($search) {
                    $w->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            })
            ->latest()->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create', ['student' => new Student]);
    }

    public function store(Request $request)
    {
        Student::create($request->validate($this->rules()));

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('enrollments.schedule.danceClass.instructor');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->validate($this->rules($student)));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        // Enrollments are removed automatically (cascade on delete)
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student and their enrollments were deleted.');
    }
}
