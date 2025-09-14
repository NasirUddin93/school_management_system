<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::orderBy('name')->get();
        return view('backend.admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10|unique:sections,name',
            'description' => 'nullable|string'
        ]);

        try {
            Section::create($request->all());
            return redirect()->route('sections.index')
                ->with('success', 'Section created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating section: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = Section::findOrFail($id);
        return view('backend.admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        return view('backend.admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:10|unique:sections,name,' . $id,
            'description' => 'nullable|string'
        ]);

        try {
            $section->update($request->all());
            return redirect()->route('sections.index')
                ->with('success', 'Section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating section: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $section = Section::findOrFail($id);

            // Check if section has related class sections or fee structures
            if ($section->classSections()->count() > 0 || $section->feeStructures()->count() > 0) {
                return redirect()->route('sections.index')
                    ->with('error', 'Cannot delete section because it has related classes or fee structures.');
            }

            $section->delete();
            return redirect()->route('sections.index')
                ->with('success', 'Section deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')
                ->with('error', 'Error deleting section: ' . $e->getMessage());
        }
    }
}
