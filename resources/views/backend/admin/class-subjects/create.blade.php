@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Assign Subject to Class Section</h2>
            </div>

            <form action="{{ route('class-subjects.store') }}" method="POST" class="px-6 py-4">
                @csrf

                <div class="mb-4">
                    <label for="class_section_id" class="block text-sm font-medium text-gray-700 mb-1">Class-Section *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_section_id') border-red-500 @enderror"
                        id="class_section_id" name="class_section_id" required>
                        <option value="">Select Class-Section</option>
                        @foreach($classSections as $classSection)
                            <option value="{{ $classSection->id }}" {{ old('class_section_id') == $classSection->id ? 'selected' : '' }}>
                                {{ $classSection->class->name }} - {{ $classSection->section->name }} ({{ $classSection->shift->name }} Shift)
                            </option>
                        @endforeach
                    </select>
                    @error('class_section_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subject_id') border-red-500 @enderror"
                        id="subject_id" name="subject_id" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }} ({{ $subject->code }})
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('class-subjects.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-link mr-1"></i> Assign Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
