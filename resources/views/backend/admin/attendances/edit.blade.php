@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Edit Attendance Record</h2>
            </div>

            <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="POST" class="px-6 py-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="enrollment_id" class="block text-sm font-medium text-gray-700 mb-1">Student *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('enrollment_id') border-red-500 @enderror"
                        id="enrollment_id" name="enrollment_id" required>
                        <option value="">Select Student</option>
                        @foreach($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" {{ old('enrollment_id', $attendance->enrollment_id) == $enrollment->id ? 'selected' : '' }}>
                                {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }} -
                                {{ $enrollment->classSection->class->name }} {{ $enrollment->classSection->section->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('enrollment_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="teacher_assignment_id" class="block text-sm font-medium text-gray-700 mb-1">Teacher/Subject (Optional)</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('teacher_assignment_id') border-red-500 @enderror"
                        id="teacher_assignment_id" name="teacher_assignment_id">
                        <option value="">Select Teacher/Subject (Optional)</option>
                        @foreach($teacherAssignments as $assignment)
                            <option value="{{ $assignment->id }}" {{ old('teacher_assignment_id', $attendance->teacher_assignment_id) == $assignment->id ? 'selected' : '' }}>
                                {{ $assignment->teacher->name }} - {{ $assignment->subject->name }} -
                                {{ $assignment->classSection->class->name }} {{ $assignment->classSection->section->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_assignment_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="attendance_date" class="block text-sm font-medium text-gray-700 mb-1">Date *</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('attendance_date') border-red-500 @enderror"
                            id="attendance_date" name="attendance_date" value="{{ old('attendance_date', $attendance->attendance_date->format('Y-m-d')) }}" required>
                        @error('attendance_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                            id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Present" {{ old('status', $attendance->status) == 'Present' ? 'selected' : '' }}>Present</option>
                            <option value="Absent" {{ old('status', $attendance->status) == 'Absent' ? 'selected' : '' }}>Absent</option>
                            <option value="Late" {{ old('status', $attendance->status) == 'Late' ? 'selected' : '' }}>Late</option>
                            <option value="Excused" {{ old('status', $attendance->status) == 'Excused' ? 'selected' : '' }}>Excused</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="remarks" class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('remarks') border-red-500 @enderror"
                        id="remarks" name="remarks" rows="3" placeholder="Optional remarks">{{ old('remarks', $attendance->remarks) }}</textarea>
                    @error('remarks')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('admin.attendances.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-save mr-1"></i> Update Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
