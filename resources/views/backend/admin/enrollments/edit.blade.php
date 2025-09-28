@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Edit Enrollment</h2>
            </div>

            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="px-6 py-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Student *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('student_id') border-red-500 @enderror"
                        id="student_id" name="student_id" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="class_section_id" class="block text-sm font-medium text-gray-700 mb-1">Class-Section *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_section_id') border-red-500 @enderror"
                            id="class_section_id" name="class_section_id" required>
                            <option value="">Select Class-Section</option>
                            @foreach($classSections as $classSection)
                                <option value="{{ $classSection->id }}" {{ old('class_section_id', $enrollment->class_section_id) == $classSection->id ? 'selected' : '' }}>
                                    {{ $classSection->class->name }} - {{ $classSection->section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_section_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="academic_year_id" class="block text-sm font-medium text-gray-700 mb-1">Academic Year *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('academic_year_id') border-red-500 @enderror"
                            id="academic_year_id" name="academic_year_id" required>
                            <option value="">Select Academic Year</option>
                            @foreach($academicYears as $academicYear)
                                <option value="{{ $academicYear->id }}" {{ old('academic_year_id', $enrollment->academic_year_id) == $academicYear->id ? 'selected' : '' }}>
                                    {{ $academicYear->name }} ({{ $academicYear->start_date->format('Y') }} - {{ $academicYear->end_date->format('Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="roll_number" class="block text-sm font-medium text-gray-700 mb-1">Roll Number</label>
                        <input type="number" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('roll_number') border-red-500 @enderror"
                            id="roll_number" name="roll_number" value="{{ old('roll_number', $enrollment->roll_number) }}" placeholder="Optional">
                        @error('roll_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="enrollment_date" class="block text-sm font-medium text-gray-700 mb-1">Enrollment Date *</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('enrollment_date') border-red-500 @enderror"
                            id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', $enrollment->enrollment_date->format('Y-m-d')) }}" required>
                        @error('enrollment_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                        id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status', $enrollment->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Completed" {{ old('status', $enrollment->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Promoted" {{ old('status', $enrollment->status) == 'Promoted' => 'selected' : '' }}>Promoted</option>
                        <option value="Transferred" {{ old('status', $enrollment->status) == 'Transferred' ? 'selected' : '' }}>Transferred</option>
                        <option value="Dropped" {{ old('status', $enrollment->status) == 'Dropped' ? 'selected' : '' }}>Dropped</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('enrollments.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-save mr-1"></i> Update Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
