<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = AcademicYear::orderBy('start_date', 'desc')->get();
        return view('backend.admin.academic_years.index', compact('academicYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year_label' => 'required|string|max:20|unique:academic_years,year_label',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Active,Closed'
        ]);

        try {
            AcademicYear::create($request->all());
            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating academic year: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $academicYear = AcademicYear::with(['enrollments.student', 'enrollments.classSection.class', 'enrollments.classSection.section'])
            ->findOrFail($id);

        return view('backend.admin.academic_years.show', compact('academicYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return view('backend.admin.academic_years.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $request->validate([
            'year_label' => 'required|string|max:20|unique:academic_years,year_label,' . $id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Active,Closed'
        ]);

        try {
            $academicYear->update($request->all());
            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating academic year: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $academicYear = AcademicYear::findOrFail($id);

            // Check if academic year has enrollments
            if ($academicYear->enrollments()->count() > 0) {
                return redirect()->route('academic-years.index')
                    ->with('error', 'Cannot delete academic year because it has enrollments.');
            }

            $academicYear->delete();
            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('academic-years.index')
                ->with('error', 'Error deleting academic year: ' . $e->getMessage());
        }
    }
}
