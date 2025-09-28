<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load exam results with related data
        $examResults = ExamResult::with(['exam', 'enrollment.student', 'subject'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.admin.exam-results.index', compact('examResults'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        $enrollments = Enrollment::with('student')->get();

        return view('backend.admin.exam-results.create', compact('exams', 'subjects', 'enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'subject_id' => 'required|exists:subjects,id',
            'marks_obtained' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:1',
        ]);

        // Calculate grade
        $percentage = ($request->marks_obtained / $request->total_marks) * 100;
        $grade = $this->calculateGrade($percentage);
        $isPassed = $percentage >= 40;

        ExamResult::create([
            'exam_id' => $request->exam_id,
            'enrollment_id' => $request->enrollment_id,
            'subject_id' => $request->subject_id,
            'marks_obtained' => $request->marks_obtained,
            'total_marks' => $request->total_marks,
            'grade' => $grade,
            'is_passed' => $isPassed,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('exam-results.index')->with('success', 'Exam result added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $examResult = ExamResult::with(['exam', 'enrollment.student', 'subject'])->findOrFail($id);

        return view('backend.admin.exam-results.show', compact('examResult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $examResult = ExamResult::findOrFail($id);
        $exams = Exam::all();
        $subjects = Subject::all();
        $enrollments = Enrollment::with('student')->get();

        return view('backend.admin.exam-results.edit', compact('examResult', 'exams', 'subjects', 'enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'subject_id' => 'required|exists:subjects,id',
            'marks_obtained' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:1',
        ]);

        $examResult = ExamResult::findOrFail($id);

        $percentage = ($request->marks_obtained / $request->total_marks) * 100;
        $grade = $this->calculateGrade($percentage);
        $isPassed = $percentage >= 40;

        $examResult->update([
            'exam_id' => $request->exam_id,
            'enrollment_id' => $request->enrollment_id,
            'subject_id' => $request->subject_id,
            'marks_obtained' => $request->marks_obtained,
            'total_marks' => $request->total_marks,
            'grade' => $grade,
            'is_passed' => $isPassed,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('exam-results.index')->with('success', 'Exam result updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $examResult = ExamResult::findOrFail($id);
        $examResult->delete();

        return redirect()->route('exam-results.index')->with('success', 'Exam result deleted successfully.');
    }

    /**
     * Private method to calculate grade
     */
    private function calculateGrade($percentage)
    {
        if ($percentage >= 80) return 'A+';
        if ($percentage >= 70) return 'A';
        if ($percentage >= 60) return 'B';
        if ($percentage >= 50) return 'C';
        if ($percentage >= 40) return 'D';
        return 'F';
    }
}
