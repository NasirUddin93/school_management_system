<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeTypes = FeeType::orderBy('name')->get();
        return view('backend.admin.fee_types.index', compact('feeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.fee_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:fee_types,name',
            'description' => 'nullable|string',
            'recurrence' => 'required|in:one_time,monthly,yearly,occasionally',
            'default_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            FeeType::create($request->all());
            return redirect()->route('fee_types.index')
                ->with('success', 'Fee type created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating fee type: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feeType = FeeType::with(['studentFees.student', 'feeStructures.class', 'feeStructures.section', 'studentFines.student'])
            ->findOrFail($id);

        return view('backend.admin.fee_types.show', compact('feeType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feeType = FeeType::findOrFail($id);
        return view('backend.admin.fee_types.edit', compact('feeType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feeType = FeeType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:fee_types,name,' . $id,
            'description' => 'nullable|string',
            'recurrence' => 'required|in:one_time,monthly,yearly,occasionally',
            'default_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $feeType->update($request->all());
            return redirect()->route('fee_types.index')
                ->with('success', 'Fee type updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating fee type: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $feeType = FeeType::findOrFail($id);

            // Check if fee type has related records
            if ($feeType->studentFees()->count() > 0 || $feeType->feeStructures()->count() > 0 || $feeType->studentFines()->count() > 0) {
                return redirect()->route('fee_types.index')
                    ->with('error', 'Cannot delete fee type because it has related records.');
            }

            $feeType->delete();
            return redirect()->route('fee_types.index')
                ->with('success', 'Fee type deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('fee_types.index')
                ->with('error', 'Error deleting fee type: ' . $e->getMessage());
        }
    }
}
