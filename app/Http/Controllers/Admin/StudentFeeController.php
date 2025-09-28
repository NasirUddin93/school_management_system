<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentFee;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\FeeType;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentFees = StudentFee::with(['student', 'feeType', 'feeStructure'])->latest()->paginate(10);

        return view('backend.admin.student-fees.index', compact('studentFees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        $feeTypes = FeeType::all();

        return view('backend.admin.student-fees.create', compact('students', 'feeStructures', 'feeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'       => 'required|exists:students,id',
            'fee_type_id'      => 'required|exists:fee_types,id',
            'fee_structure_id' => 'nullable|exists:fee_structures,id',
            'amount'           => 'required|numeric|min:0',
            'late_fine'        => 'nullable|numeric|min:0',
            'due_date'         => 'required|date',
        ]);

        $validated['total_amount'] = $validated['amount'] + ($validated['late_fine'] ?? 0);
        $validated['status'] = 'unpaid';

        StudentFee::create($validated);

        return redirect()->route('student-fees.index')->with('success', 'Student fee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $studentFee = StudentFee::with(['student', 'feeType', 'feeStructure', 'payments'])->findOrFail($id);

        return view('backend.admin.student-fees.show', compact('studentFee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $studentFee = StudentFee::findOrFail($id);
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        $feeTypes = FeeType::all();

        return view('backend.admin.student-fees.edit', compact('studentFee', 'students', 'feeStructures', 'feeTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $studentFee = StudentFee::findOrFail($id);

        $validated = $request->validate([
            'student_id'       => 'required|exists:students,id',
            'fee_type_id'      => 'required|exists:fee_types,id',
            'fee_structure_id' => 'nullable|exists:fee_structures,id',
            'amount'           => 'required|numeric|min:0',
            'late_fine'        => 'nullable|numeric|min:0',
            'due_date'         => 'required|date',
            'status'           => 'required|in:unpaid,partially_paid,paid,overdue,cancelled',
        ]);

        $validated['total_amount'] = $validated['amount'] + ($validated['late_fine'] ?? 0);

        $studentFee->update($validated);

        return redirect()->route('student-fees.index')->with('success', 'Student fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $studentFee = StudentFee::findOrFail($id);
        $studentFee->delete();

        return redirect()->route('student-fees.index')->with('success', 'Student fee deleted successfully.');
    }
}
