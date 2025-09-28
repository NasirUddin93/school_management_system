<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('first_name')->paginate(10);
        return view('backend.admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $classSections = ClassSection::with('class', 'section')->get();
        return view('backend.admin.teachers.create', compact('subjects', 'classSections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'qualification' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'zip' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'class_sections' => 'nullable|array',
            'class_sections.*' => 'exists:class_sections,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('teacher_profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        // $validated['password'] = Hash::make($validated['password']);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Create teacher
        $teacher = Teacher::create($validated);

        // Sync subjects if provided
        if (isset($validated['subjects'])) {
            $teacher->subjects()->sync($validated['subjects']);
        }

        // Sync class sections if provided
        if (isset($validated['class_sections'])) {
            $teacher->classSections()->sync($validated['class_sections']);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with(['subjects', 'classSections.class', 'classSections.section'])->findOrFail($id);
        return view('backend.admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::with(['subjects', 'classSections'])->findOrFail($id);
        $subjects = Subject::all();
        $classSections = ClassSection::with('class', 'section')->get();

        return view('backend.admin.teachers.edit', compact('teacher', 'subjects', 'classSections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
$teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers')->ignore($teacher->id),
            ],
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'qualification' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'zip' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'is_active' => 'boolean',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'class_sections' => 'nullable|array',
            'class_sections.*' => 'exists:class_sections,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($teacher->profile_picture) {
                Storage::disk('public')->delete($teacher->profile_picture);
            }

            $path = $request->file('profile_picture')->store('teacher_profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        // Update password only if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update teacher
        $teacher->update($validated);

        // Sync subjects if provided
        if (isset($validated['subjects'])) {
            $teacher->subjects()->sync($validated['subjects']);
        } else {
            $teacher->subjects()->detach();
        }

        // Sync class sections if provided
        if (isset($validated['class_sections'])) {
            $teacher->classSections()->sync($validated['class_sections']);
        } else {
            $teacher->classSections()->detach();
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete profile picture if exists
        if ($teacher->profile_picture) {
            Storage::disk('public')->delete($teacher->profile_picture);
        }

        // Detach relationships
        $teacher->subjects()->detach();
        $teacher->classSections()->detach();

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');

    }
}
