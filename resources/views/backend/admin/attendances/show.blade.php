@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Attendance Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.attendances.edit', $attendance->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.attendances.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Student Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Student Name</span>
                                <span class="block text-lg font-semibold text-gray-800">
                                    {{ $attendance->enrollment->student->first_name }} {{ $attendance->enrollment->student->last_name }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Student Code</span>
                                <span class="block text-gray-800">{{ $attendance->enrollment->student->student_code }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class-Section</span>
                                <span class="block text-gray-800">
                                    {{ $attendance->enrollment->classSection->class->name }} - {{ $attendance->enrollment->classSection->section->name }}
                                </span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Roll Number</span>
                                <span class="block text-gray-800">{{ $attendance->enrollment->roll_number ?: 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Attendance Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Date</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $attendance->attendance_date->format('F d, Y') }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @php
                                    $statusColors = [
                                        'Present' => 'bg-green-100 text-green-800',
                                        'Absent' => 'bg-red-100 text-red-800',
                                        'Late' => 'bg-yellow-100 text-yellow-800',
                                        'Excused' => 'bg-blue-100 text-blue-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$attendance->status] }}">
                                    {{ $attendance->status }}
                                </span>
                            </div>
                            @if($attendance->teacherAssignment)
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Teacher</span>
                                <span class="block text-gray-800">{{ $attendance->teacherAssignment->teacher->name }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Subject</span>
                                <span class="block text-gray-800">{{ $attendance->teacherAssignment->subject->name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Remarks</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-800">{{ $attendance->remarks ?: 'No remarks provided' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Record Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Recorded On</span>
                                <span class="block text-gray-800">{{ $attendance->created_at->format('F d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Last Updated</span>
                                <span class="block text-gray-800">{{ $attendance->updated_at->format('F d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
