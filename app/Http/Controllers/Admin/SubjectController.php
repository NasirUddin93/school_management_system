<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('backend.admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name',
            'code' => 'required|string|max:20|unique:subjects,code',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            Subject::create($request->all());
            return redirect()->route('subjects.index')
                ->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with([
            'teachers',
            'classSections.class',
            'classSections.section',
            'exams',
            'teacherAssignments.teacher'
        ])->findOrFail($id);

        return view('backend.admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        return view('backend.admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name,' . $id,
            'code' => 'required|string|max:20|unique:subjects,code,' . $id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $subject->update($request->all());
            return redirect()->route('subjects.index')
                ->with('success', 'Subject updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try {
            $subject = Subject::findOrFail($id);

            // Check if subject has related records
            if ($subject->teachers()->count() > 0 || $subject->exams()->count() > 0 ||
                $subject->teacherAssignments()->count() > 0 || $subject->examResults()->count() > 0) {
                return redirect()->route('subjects.index')
                    ->with('error', 'Cannot delete subject because it has related records.');
            }

            $subject->delete();
            return redirect()->route('subjects.index')
                ->with('success', 'Subject deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')
                ->with('error', 'Error deleting subject: ' . $e->getMessage());
        }
    }
}
