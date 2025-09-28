<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeStructure;
use App\Models\FeeType;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeStructures = FeeStructure::with(['feeType', 'class', 'section', 'shift'])
            ->orderBy('effective_date', 'desc')
            ->get();

        return view('backend.admin.fee-structures.index', compact('feeStructures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feeTypes = FeeType::where('status', 'active')->orderBy('name')->get();
        $classes = Classes::orderBy('order_number')->get();
        $sections = Section::orderBy('name')->get();
        $shifts = Shift::orderBy('name')->get();

        return view('backend.admin.fee-structures.create', compact('feeTypes', 'classes', 'sections', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fee_type_id' => 'required|exists:fee_types,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:active,inactive'
        ]);

        // Check if this combination already exists
        $exists = FeeStructure::where('fee_type_id', $request->fee_type_id)
            ->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('shift_id', $request->shift_id)
            ->where('effective_date', $request->effective_date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'A fee structure with these details already exists for this effective date.')
                ->withInput();
        }

        try {
            FeeStructure::create($request->all());
            return redirect()->route('fee-structures.index')
                ->with('success', 'Fee structure created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating fee structure: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feeStructure = FeeStructure::with([
            'feeType',
            'class',
            'section',
            'shift',
            'studentFees.student'
        ])->findOrFail($id);

        return view('backend.admin.fee-structures.show', compact('feeStructure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $feeTypes = FeeType::where('status', 'active')->orderBy('name')->get();
        $classes = Classes::orderBy('order_number')->get();
        $sections = Section::orderBy('name')->get();
        $shifts = Shift::orderBy('name')->get();

        return view('backend.admin.fee-structures.edit', compact('feeStructure', 'feeTypes', 'classes', 'sections', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);

        $request->validate([
            'fee_type_id' => 'required|exists:fee_types,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
            'status' => 'required|in:active,inactive'
        ]);

        // Check if this combination already exists (excluding current record)
        $exists = FeeStructure::where('fee_type_id', $request->fee_type_id)
            ->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('shift_id', $request->shift_id)
            ->where('effective_date', $request->effective_date)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another fee structure with these details already exists for this effective date.')
                ->withInput();
        }

        try {
            $feeStructure->update($request->all());
            return redirect()->route('fee-structures.index')
                ->with('success', 'Fee structure updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating fee structure: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $feeStructure = FeeStructure::findOrFail($id);

            // Check if fee structure has student fees
            if ($feeStructure->studentFees()->count() > 0) {
                return redirect()->route('fee-structures.index')
                    ->with('error', 'Cannot delete fee structure because it has student fees associated.');
            }

            $feeStructure->delete();
            return redirect()->route('fee-structures.index')
                ->with('success', 'Fee structure deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('fee-structures.index')
                ->with('error', 'Error deleting fee structure: ' . $e->getMessage());
        }
    }
}
