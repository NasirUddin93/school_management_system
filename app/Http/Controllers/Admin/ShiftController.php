<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::orderBy('name')->get();
        return view('backend.admin.shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('backend.admin.shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:shifts,name',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string'
        ]);

        try {
            Shift::create($request->all());
            return redirect()->route('shifts.index')
                ->with('success', 'Shift created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating shift: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shift = Shift::with(['classSections.class', 'classSections.section', 'feeStructures'])->findOrFail($id);
        return view('backend.admin.shifts.show', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $shift = Shift::findOrFail($id);
        return view('backend.admin.shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shift = Shift::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50|unique:shifts,name,' . $id,
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string'
        ]);

        try {
            $shift->update($request->all());
            return redirect()->route('shifts.index')
                ->with('success', 'Shift updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating shift: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     try {
            $shift = Shift::findOrFail($id);

            // Check if shift has related class sections or fee structures
            if ($shift->classSections()->count() > 0 || $shift->feeStructures()->count() > 0) {
                return redirect()->route('shifts.index')
                    ->with('error', 'Cannot delete shift because it has related classes or fee structures.');
            }

            $shift->delete();
            return redirect()->route('shifts.index')
                ->with('success', 'Shift deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('shifts.index')
                ->with('error', 'Error deleting shift: ' . $e->getMessage());
        }

    }
}
