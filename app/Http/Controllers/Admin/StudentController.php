<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['classSection.class', 'classSection.section', 'classSection.shift'])
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('backend.admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             $classSections = ClassSection::with(['class', 'section', 'shift'])
            ->orderBy('class_id')
            ->orderBy('section_id')
            ->get();

        return view('backend.admin.students.create', compact('classSections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
            'student_code' => 'required|string|max:20|unique:students,student_code',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date|before:today',
            'guardian_name' => 'required|string|max:100',
            'guardian_phone' => 'required|string|max:15',
            'address' => 'required|string',
            'admission_date' => 'required|date',
            'class_section_id' => 'required|exists:class_sections,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive,graduated,transferred'
        ]);

        try {
            $data = $request->all();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = 'student_' . time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('students', $filename, 'public');
                $data['photo'] = $path;
            }

            Student::create($data);

            return redirect()->route('students.index')
                ->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $student = Student::with([
            'classSection.class',
            'classSection.section',
            'classSection.shift',
            'enrollments',
            'attendances',
            'studentFees'
        ])->findOrFail($id);

        return view('backend.admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $classSections = ClassSection::with(['class', 'section', 'shift'])
            ->orderBy('class_id')
            ->orderBy('section_id')
            ->get();

        return view('backend.admin.students.edit', compact('student', 'classSections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
             $student = Student::findOrFail($id);

        $request->validate([
            'student_code' => 'required|string|max:20|unique:students,student_code,' . $id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date|before:today',
            'guardian_name' => 'required|string|max:100',
            'guardian_phone' => 'required|string|max:15',
            'address' => 'required|string',
            'admission_date' => 'required|date',
            'class_section_id' => 'required|exists:class_sections,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive,graduated,transferred'
        ]);

        try {
            $data = $request->all();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($student->photo) {
                    Storage::disk('public')->delete($student->photo);
                }

                $photo = $request->file('photo');
                $filename = 'student_' . time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('students', $filename, 'public');
                $data['photo'] = $path;
            }

            $student->update($data);

            return redirect()->route('students.index')
                ->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       try {
            $student = Student::findOrFail($id);

            // Check if student has related records
            if ($student->enrollments()->count() > 0 || $student->studentFees()->count() > 0) {
                return redirect()->route('students.index')
                    ->with('error', 'Cannot delete student because they have related records.');
            }

            // Delete photo if exists
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }

            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')
                ->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }
}
