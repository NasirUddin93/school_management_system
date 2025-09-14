<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::orderBy('order_number')->get();
        return view('backend.admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextOrderNumber = SchoolClass::max('order_number') + 1;
        return view('backend.admin.classes.create', compact('nextOrderNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:classes,name',
            'order_number' => 'required|integer|min:1|unique:classes,order_number',
            'description' => 'nullable|string'
        ]);

        try {
            SchoolClass::create($request->all());
            return redirect()->route('classes.index')
                ->with('success', 'Class created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating class: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = SchoolClass::with(['classSections', 'feeStructures'])->findOrFail($id);
        return view('backend.admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('backend.admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = SchoolClass::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50|unique:classes,name,' . $id,
            'order_number' => 'required|integer|min:1|unique:classes,order_number,' . $id,
            'description' => 'nullable|string'
        ]);

        try {
            $class->update($request->all());
            return redirect()->route('classes.index')
                ->with('success', 'Class updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating class: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
               try {
            $class = SchoolClass::findOrFail($id);

            // Check if class has related sections or fee structures
            if ($class->classSections()->count() > 0 || $class->feeStructures()->count() > 0) {
                return redirect()->route('classes.index')
                    ->with('error', 'Cannot delete class because it has related sections or fee structures.');
            }

            $class->delete();
            return redirect()->route('classes.index')
                ->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('classes.index')
                ->with('error', 'Error deleting class: ' . $e->getMessage());
        }
    }
}
