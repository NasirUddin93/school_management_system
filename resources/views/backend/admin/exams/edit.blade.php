@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Edit Exam: {{ $exam->name }}</h2>
            </div>

            <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="px-6 py-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Exam Name *</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        id="name" name="name" value="{{ old('name', $exam->name) }}" required maxlength="100" placeholder="e.g., Midterm Exam, Final Exam">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        id="description" name="description" rows="3" placeholder="Exam description and instructions">{{ old('description', $exam->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="exam_date" class="block text-sm font-medium text-gray-700 mb-1">Exam Date *</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('exam_date') border-red-500 @enderror"
                            {{-- id="exam_date" name="exam_date" value="{{ old('exam_date', $exam->exam_date->format('Y-m-d')) }}" required> --}}
                        @error('exam_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                            id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Scheduled" {{ old('status', $exam->status) == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="Completed" {{ old('status', $exam->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status', $exam->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="class_section_id" class="block text-sm font-medium text-gray-700 mb-1">Class-Section *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_section_id') border-red-500 @enderror"
                            id="class_section_id" name="class_section_id" required>
                            <option value="">Select Class-Section</option>
                            @foreach($classSections as $classSection)
                                <option value="{{ $classSection->id }}" {{ old('class_section_id', $exam->class_section_id) == $classSection->id ? 'selected' : '' }}>
                                    {{ $classSection->class->name }} - {{ $classSection->section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_section_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subject_id') border-red-500 @enderror"
                            id="subject_id" name="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="teacher_assignment_id" class="block text-sm font-medium text-gray-700 mb-1">Teacher Assignment (Optional)</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('teacher_assignment_id') border-red-500 @enderror"
                        id="teacher_assignment_id" name="teacher_assignment_id">
                        <option value="">Select Teacher Assignment</option>
                        @foreach($teacherAssignments as $assignment)
                            <option value="{{ $assignment->id }}" {{ old('teacher_assignment_id', $exam->teacher_assignment_id) == $assignment->id ? 'selected' : '' }}>
                                {{ $assignment->teacher->name }} - {{ $assignment->classSection->class->name }} {{ $assignment->classSection->section->name }} - {{ $assignment->subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_assignment_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('exams.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-save mr-1"></i> Update Exam
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
