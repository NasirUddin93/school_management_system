<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\ClassSection;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classSubjects = ClassSubject::with(['classSection.class', 'classSection.section', 'subject'])
            ->orderBy('class_section_id')
            ->orderBy('subject_id')
            ->get();

        return view('backend.admin.class-subjects.index', compact('classSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();

        return view('backend.admin.class-subjects.create', compact('classSections', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        // Check if this combination already exists
        $exists = ClassSubject::where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This subject is already assigned to this class section.')
                ->withInput();
        }

        try {
            ClassSubject::create($request->all());
            return redirect()->route('class-subjects.index')
                ->with('success', 'Subject assigned to class section successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error assigning subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classSubject = ClassSubject::with([
            'classSection.class',
            'classSection.section',
            'subject',
            'classSection.teachers.teacher'
        ])->findOrFail($id);

        return view('backend.admin.class-subjects.show', compact('classSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classSubject = ClassSubject::findOrFail($id);
        $classSections = ClassSection::with(['class', 'section'])->orderBy('class_id')->get();
        $subjects = Subject::where('status', 'active')->orderBy('name')->get();

        return view('backend.admin.class-subjects.edit', compact('classSubject', 'classSections', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classSubject = ClassSubject::findOrFail($id);

        $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        // Check if this combination already exists (excluding current record)
        $exists = ClassSubject::where('class_section_id', $request->class_section_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'This subject is already assigned to this class section.')
                ->withInput();
        }

        try {
            $classSubject->update($request->all());
            return redirect()->route('class-subjects.index')
                ->with('success', 'Class subject assignment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating assignment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classSubject = ClassSubject::findOrFail($id);
            $classSubject->delete();

            return redirect()->route('class-subjects.index')
                ->with('success', 'Class subject assignment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('class-subjects.index')
                ->with('error', 'Error deleting assignment: ' . $e->getMessage());
        }
    }
}
