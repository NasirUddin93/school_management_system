<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ClassSection;
use App\Models\Subject;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with(['classSection.class', 'classSection.section', 'subject', 'teacherAssignment.teacher'])
            ->orderBy('exam_date', 'desc')
            ->get();

        return view('backend.admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();
        $teacherAssignments = TeacherAssignment::with(['teacher', 'classSection.class', 'classSection.section', 'subject'])
            ->orderBy('teacher_id')
            ->get();

        return view('backend.admin.exams.create', compact('classSections', 'subjects', 'teacherAssignments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'exam_date' => 'required|date|after_or_equal:today',
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_assignment_id' => 'nullable|exists:teacher_assignments,id',
            'status' => 'required|in:Scheduled,Completed,Cancelled'
        ]);

        // Check if exam already exists for this class-section, subject, and date
        $exists = Exam::where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->where('exam_date', $request->exam_date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'An exam already exists for this class-section, subject, and date.')
                ->withInput();
        }

        try {
            Exam::create($request->all());
            return redirect()->route('exams.index')
                ->with('success', 'Exam created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating exam: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exam::with([
            'classSection.class',
            'classSection.section',
            'subject',
            'teacherAssignment.teacher',
            'results.student'
        ])->findOrFail($id);

        return view('backend.admin.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();
        $teacherAssignments = TeacherAssignment::with(['teacher', 'classSection.class', 'classSection.section', 'subject'])
            ->orderBy('teacher_id')
            ->get();

        return view('backend.admin.exams.edit', compact('exam', 'classSections', 'subjects', 'teacherAssignments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'exam_date' => 'required|date',
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_assignment_id' => 'nullable|exists:teacher_assignments,id',
            'status' => 'required|in:Scheduled,Completed,Cancelled'
        ]);

        // Check if exam already exists for this class-section, subject, and date (excluding current exam)
        $exists = Exam::where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->where('exam_date', $request->exam_date)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another exam already exists for this class-section, subject, and date.')
                ->withInput();
        }

        try {
            $exam->update($request->all());
            return redirect()->route('exams.index')
                ->with('success', 'Exam updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating exam: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $exam = Exam::findOrFail($id);

            // Check if exam has results
            if ($exam->results()->count() > 0) {
                return redirect()->route('exams.index')
                    ->with('error', 'Cannot delete exam because it has results recorded.');
            }

            $exam->delete();
            return redirect()->route('exams.index')
                ->with('success', 'Exam deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('exams.index')
                ->with('error', 'Error deleting exam: ' . $e->getMessage());
        }
    }
}
