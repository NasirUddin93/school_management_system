<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\TeacherAssignment;
use App\Models\ClassSection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with(['enrollment.student', 'enrollment.classSection.class', 'enrollment.classSection.section', 'teacherAssignment.teacher'])
            ->orderBy('attendance_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.admin.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::with(['student', 'classSection.class', 'classSection.section'])
            ->where('status', 'Active')
            ->orderBy('class_section_id')
            ->get();

        $teacherAssignments = TeacherAssignment::with(['teacher', 'classSection.class', 'classSection.section', 'subject'])
            ->where('status', 'Active')
            ->orderBy('teacher_id')
            ->get();

        return view('backend.admin.attendances.create', compact('enrollments', 'teacherAssignments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'teacher_assignment_id' => 'nullable|exists:teacher_assignments,id',
            'attendance_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:Present,Absent,Late,Excused',
            'remarks' => 'nullable|string|max:255'
        ]);

        // Check if attendance already exists for this student and date
        $exists = Attendance::where('enrollment_id', $request->enrollment_id)
            ->where('teacher_assignment_id', $request->teacher_assignment_id)
            ->where('attendance_date', $request->attendance_date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Attendance record already exists for this student and date.')
                ->withInput();
        }

        try {
            Attendance::create($request->all());
            return redirect()->route('attendances.index')
                ->with('success', 'Attendance recorded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error recording attendance: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with([
            'enrollment.student',
            'enrollment.classSection.class',
            'enrollment.classSection.section',
            'teacherAssignment.teacher',
            'teacherAssignment.subject'
        ])->findOrFail($id);

        return view('backend.admin.attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $enrollments = Enrollment::with(['student', 'classSection.class', 'classSection.section'])
            ->where('status', 'Active')
            ->orderBy('class_section_id')
            ->get();

        $teacherAssignments = TeacherAssignment::with(['teacher', 'classSection.class', 'classSection.section', 'subject'])
            ->where('status', 'Active')
            ->orderBy('teacher_id')
            ->get();

        return view('backend.admin.attendances.edit', compact('attendance', 'enrollments', 'teacherAssignments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'teacher_assignment_id' => 'nullable|exists:teacher_assignments,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late,Excused',
            'remarks' => 'nullable|string|max:255'
        ]);

        // Check if attendance already exists for this student and date (excluding current record)
        $exists = Attendance::where('enrollment_id', $request->enrollment_id)
            ->where('teacher_assignment_id', $request->teacher_assignment_id)
            ->where('attendance_date', $request->attendance_date)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another attendance record already exists for this student and date.')
                ->withInput();
        }

        try {
            $attendance->update($request->all());
            return redirect()->route('attendances.index')
                ->with('success', 'Attendance updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating attendance: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $attendance = Attendance::findOrFail($id);
            $attendance->delete();

            return redirect()->route('attendances.index')
                ->with('success', 'Attendance record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('attendances.index')
                ->with('error', 'Error deleting attendance record: ' . $e->getMessage());
        }
    }

    /**
     * Bulk attendance creation for a class section
     */
    public function bulkCreate()
    {
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $teacherAssignments = TeacherAssignment::with(['teacher', 'subject'])
            ->where('status', 'Active')
            ->orderBy('teacher_id')
            ->get();

        return view('backend.admin.attendances.bulk-create', compact('classSections', 'teacherAssignments'));
    }

    /**
     * Store bulk attendance records
     */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'teacher_assignment_id' => 'nullable|exists:teacher_assignments,id',
            'attendance_date' => 'required|date|before_or_equal:today',
            'attendances' => 'required|array',
            'attendances.*.enrollment_id' => 'required|exists:enrollments,id',
            'attendances.*.status' => 'required|in:Present,Absent,Late,Excused',
            'attendances.*.remarks' => 'nullable|string|max:255'
        ]);

        try {
            $attendanceDate = $request->attendance_date;
            $teacherAssignmentId = $request->teacher_assignment_id;

            foreach ($request->attendances as $attendanceData) {
                // Check if attendance already exists
                $exists = Attendance::where('enrollment_id', $attendanceData['enrollment_id'])
                    ->where('teacher_assignment_id', $teacherAssignmentId)
                    ->where('attendance_date', $attendanceDate)
                    ->exists();

                if (!$exists) {
                    Attendance::create([
                        'enrollment_id' => $attendanceData['enrollment_id'],
                        'teacher_assignment_id' => $teacherAssignmentId,
                        'attendance_date' => $attendanceDate,
                        'status' => $attendanceData['status'],
                        'remarks' => $attendanceData['remarks'] ?? null
                    ]);
                }
            }

            return redirect()->route('attendances.index')
                ->with('success', 'Bulk attendance recorded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error recording bulk attendance: ' . $e->getMessage())
                ->withInput();
        }
    }
}
