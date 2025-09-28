<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\ClassSection;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'classSection.class', 'classSection.section', 'academicYear'])
            ->orderBy('enrollment_date', 'desc')
            ->get();

        return view('backend.admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('status', 'active')->orderBy('first_name')->get();
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $academicYears = AcademicYear::orderBy('start_date', 'desc')->get();

        return view('backend.admin.enrollments.create', compact('students', 'classSections', 'academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'roll_number' => 'nullable|integer|min:1',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:Active,Completed,Promoted,Transferred,Dropped'
        ]);

        // Check if student is already enrolled for this academic year
        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This student is already enrolled for the selected academic year.')
                ->withInput();
        }

        try {
            Enrollment::create($request->all());
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating enrollment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollment = Enrollment::with([
            'student',
            'classSection.class',
            'classSection.section',
            'academicYear',
            'attendances',
            'examResults.exam',
            'fees.feeType'
        ])->findOrFail($id);

        return view('backend.admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::where('status', 'active')->orderBy('first_name')->get();
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $academicYears = AcademicYear::orderBy('start_date', 'desc')->get();

        return view('backend.admin.enrollments.edit', compact('enrollment', 'students', 'classSections', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'roll_number' => 'nullable|integer|min:1',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:Active,Completed,Promoted,Transferred,Dropped'
        ]);

        // Check if another enrollment already exists for this student and academic year
        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another enrollment already exists for this student and academic year.')
                ->withInput();
        }

        try {
            $enrollment->update($request->all());
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating enrollment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);

            // Check if enrollment has related records
            if ($enrollment->attendances()->count() > 0 || $enrollment->examResults()->count() > 0 || $enrollment->fees()->count() > 0) {
                return redirect()->route('enrollments.index')
                    ->with('error', 'Cannot delete enrollment because it has related records.');
            }

            $enrollment->delete();
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('enrollments.index')
                ->with('error', 'Error deleting enrollment: ' . $e->getMessage());
        }
    }
}
