<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSection;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;

class ClassSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classSections = ClassSection::with(['class', 'section', 'shift'])
            ->orderBy('class_id')
            ->orderBy('section_id')
            ->get();

        return view('backend.admin.class-sections.index', compact('classSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::orderBy('order_number')->get();
        $sections = Section::orderBy('name')->get();
        $shifts = Shift::orderBy('name')->get();

        return view('backend.admin.class-sections.create', compact('classes', 'sections', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'shift_id' => 'required|exists:shifts,id',
            'capacity' => 'nullable|integer|min:1',
            'description' => 'nullable|string'
        ]);

        // Check if this combination already exists
        $exists = ClassSection::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('shift_id', $request->shift_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This class-section-shift combination already exists.')
                ->withInput();
        }

        try {
            ClassSection::create($request->all());
            return redirect()->route('class-sections.index')
                ->with('success', 'Class section created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating class section: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classSection = ClassSection::with([
            'class',
            'section',
            'shift',
            'students',
            'subjects',
            'teachers'
        ])->findOrFail($id);

        return view('backend.admin.class-sections.show', compact('classSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classSection = ClassSection::findOrFail($id);
        $classes = Classes::orderBy('order_number')->get();
        $sections = Section::orderBy('name')->get();
        $shifts = Shift::orderBy('name')->get();

        return view('backend.admin.class-sections.edit', compact('classSection', 'classes', 'sections', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $classSection = ClassSection::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'shift_id' => 'required|exists:shifts,id',
            'capacity' => 'nullable|integer|min:1',
            'description' => 'nullable|string'
        ]);

        // Check if this combination already exists (excluding current record)
        $exists = ClassSection::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('shift_id', $request->shift_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This class-section-shift combination already exists.')
                ->withInput();
        }

        try {
            $classSection->update($request->all());
            return redirect()->route('class-sections.index')
                ->with('success', 'Class section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating class section: ' . $e->getMessage())
                ->withInput();
        }
    }



    /**
     * Get students for a class section
     */
    public function getStudents($id)
    {
        try {
            $classSection = ClassSection::with(['enrollments.student' => function($query) {
                $query->orderBy('roll_number');
            }])->findOrFail($id);

            $students = $classSection->enrollments->where('status', 'Active');

            return response()->json([
                'success' => true,
                'students' => $students
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching students'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
              try {
            $classSection = ClassSection::findOrFail($id);

            // Check if class section has related students
            if ($classSection->students()->count() > 0) {
                return redirect()->route('class-sections.index')
                    ->with('error', 'Cannot delete class section because it has students assigned.');
            }

            // Check if class section has related enrollments
            if ($classSection->enrollments()->count() > 0) {
                return redirect()->route('class-sections.index')
                    ->with('error', 'Cannot delete class section because it has enrollments.');
            }

            $classSection->delete();
            return redirect()->route('class-sections.index')
                ->with('success', 'Class section deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('class-sections.index')
                ->with('error', 'Error deleting class section: ' . $e->getMessage());
        }

    }
}
