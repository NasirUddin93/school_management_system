<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherAssignment;
use App\Models\Teacher;
use App\Models\ClassSection;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherAssignments = TeacherAssignment::with(['teacher', 'classSection.class', 'classSection.section', 'subject'])
            ->orderBy('teacher_id')
            ->orderBy('class_section_id')
            ->get();

        return view('backend.admin.teacher-assignments.index', compact('teacherAssignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();

        return view('backend.admin.teacher-assignments.create', compact('teachers', 'classSections', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'status' => 'required|in:Active,Inactive'
        ]);

        // Check if this combination already exists
        $exists = TeacherAssignment::where('teacher_id', $request->teacher_id)
            ->where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This teacher is already assigned to this class-section and subject.')
                ->withInput();
        }

        try {
            TeacherAssignment::create($request->all());
            return redirect()->route('teacher-assignments.index')
                ->with('success', 'Teacher assignment created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating teacher assignment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacherAssignment = TeacherAssignment::with([
            'teacher',
            'classSection.class',
            'classSection.section',
            'subject',
            'attendances',
            'exams'
        ])->findOrFail($id);

        return view('backend.admin.teacher-assignments.show', compact('teacherAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherAssignment = TeacherAssignment::findOrFail($id);
        $teachers = Teacher::where('is_active', 1)->orderBy('first_name')->get();
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();

        return view('backend.admin.teacher-assignments.edit', compact('teacherAssignment', 'teachers', 'classSections', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacherAssignment = TeacherAssignment::findOrFail($id);

        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'status' => 'required|in:Active,Inactive'
        ]);

        // Check if this combination already exists (excluding current record)
        $exists = TeacherAssignment::where('teacher_id', $request->teacher_id)
            ->where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another teacher assignment with these details already exists.')
                ->withInput();
        }

        try {
            $teacherAssignment->update($request->all());
            return redirect()->route('teacher-assignments.index')
                ->with('success', 'Teacher assignment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating teacher assignment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacherAssignment = TeacherAssignment::findOrFail($id);

            // Check if teacher assignment has related records
            if ($teacherAssignment->attendances()->count() > 0 || $teacherAssignment->exams()->count() > 0) {
                return redirect()->route('teacher-assignments.index')
                    ->with('error', 'Cannot delete teacher assignment because it has related records.');
            }

            $teacherAssignment->delete();
            return redirect()->route('teacher-assignments.index')
                ->with('success', 'Teacher assignment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('teacher-assignments.index')
                ->with('error', 'Error deleting teacher assignment: ' . $e->getMessage());
        }
    }
}
