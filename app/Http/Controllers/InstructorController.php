<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    private function rules(?Instructor $instructor = null): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255', Rule::unique('instructors', 'email')->ignore($instructor?->id)],
            'phone'      => ['nullable', 'string', 'max:30'],
            'specialty'  => ['required', 'string', 'max:100'],
        ];
    }

    public function index(Request $request)
    {
        $instructors = Instructor::withCount('danceClasses')
            ->when($request->q, function ($query, $search) {
                $query->where(function ($w) use ($search) {
                    $w->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('specialty', 'like', "%$search%");
                });
            })
            ->latest()->paginate(10)->withQueryString();

        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('instructors.create', ['instructor' => new Instructor]);
    }

    public function store(Request $request)
    {
        Instructor::create($request->validate($this->rules()));

        return redirect()->route('instructors.index')->with('success', 'Instructor added successfully.');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load('danceClasses.schedules');

        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $instructor->update($request->validate($this->rules($instructor)));

        return redirect()->route('instructors.index')->with('success', 'Instructor updated successfully.');
    }

    public function destroy(Instructor $instructor)
    {
        // Prevent orphaned classes
        if ($instructor->danceClasses()->exists()) {
            return back()->with('error', 'Cannot delete this instructor because they still have dance classes. Reassign or delete those classes first.');
        }

        $instructor->delete();

        return redirect()->route('instructors.index')->with('success', 'Instructor deleted successfully.');
    }
}
