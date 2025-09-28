<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFine;
use App\Models\Student;
use App\Models\FeeType;

class StudentFineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fines = StudentFine::with(['student', 'feeType'])->latest()->paginate(10);
        return view('backend.admin.student-fines.index', compact('fines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $feeTypes = FeeType::all();
        return view('backend.admin.student-fines.create', compact('students', 'feeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'  => 'required|exists:students,id',
            'fee_type_id' => 'nullable|exists:fee_types,id',
            'amount'      => 'required|numeric|min:0',
            'fine_date'   => 'required|date',
            'due_date'    => 'nullable|date|after_or_equal:fine_date',
            'reason'      => 'nullable|string|max:255',
            'status'      => 'required|in:unpaid,partially_paid,paid,cancelled',
            'remarks'     => 'nullable|string'
        ]);

        StudentFine::create($request->all());

        return redirect()->route('student-fines.index')->with('success', 'Student fine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fine = StudentFine::with(['student', 'feeType'])->findOrFail($id);
        return view('backend.admin.student-fines.show', compact('fine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fine = StudentFine::findOrFail($id);
        $students = Student::all();
        $feeTypes = FeeType::all();
        return view('backend.admin.student-fines.edit', compact('fine', 'students', 'feeTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student_id'  => 'required|exists:students,id',
            'fee_type_id' => 'nullable|exists:fee_types,id',
            'amount'      => 'required|numeric|min:0',
            'fine_date'   => 'required|date',
            'due_date'    => 'nullable|date|after_or_equal:fine_date',
            'reason'      => 'nullable|string|max:255',
            'status'      => 'required|in:unpaid,partially_paid,paid,cancelled',
            'remarks'     => 'nullable|string'
        ]);

        $fine = StudentFine::findOrFail($id);
        $fine->update($request->all());

        return redirect()->route('student-fines.index')->with('success', 'Student fine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fine = StudentFine::findOrFail($id);
        $fine->delete();

        return redirect()->route('student-fines.index')->with('success', 'Student fine deleted successfully.');
    }
}
