@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Enrollment Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('enrollments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
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
                                    {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Student Code</span>
                                <span class="block text-gray-800">{{ $enrollment->student->student_code }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Guardian</span>
                                <span class="block text-gray-800">{{ $enrollment->student->guardian_name }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Contact</span>
                                <span class="block text-gray-800">{{ $enrollment->student->guardian_phone }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Enrollment Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class-Section</span>
                                <span class="block text-lg font-semibold text-gray-800">
                                    {{ $enrollment->classSection->class->name }} - {{ $enrollment->classSection->section->name }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Academic Year</span>
                                <span class="block text-gray-800">{{ $enrollment->academicYear->name }}</span>
                                <span class="block text-sm text-gray-600">
                                    ({{ $enrollment->academicYear->start_date->format('M d, Y') }} - {{ $enrollment->academicYear->end_date->format('M d, Y') }})
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Roll Number</span>
                                <span class="block text-gray-800">{{ $enrollment->roll_number ?: 'N/A' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Enrollment Date</span>
                                <span class="block text-gray-800">{{ $enrollment->enrollment_date->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @php
                                    $statusColors = [
                                        'Active' => 'bg-green-100 text-green-800',
                                        'Completed' => 'bg-blue-100 text-blue-800',
                                        'Promoted' => 'bg-purple-100 text-purple-800',
                                        'Transferred' => 'bg-yellow-100 text-yellow-800',
                                        'Dropped' => 'bg-red-100 text-red-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$enrollment->status] }}">
                                    {{ $enrollment->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <span class="block text-2xl font-bold text-blue-600">{{ $enrollment->attendances->count() }}</span>
                        <span class="block text-sm text-gray-600">Attendance Records</span>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <span class="block text-2xl font-bold text-green-600">{{ $enrollment->examResults->count() }}</span>
                        <span class="block text-sm text-gray-600">Exam Results</span>
                    </div>

                    <div class="bg-purple-50 rounded-lg p-4 text-center">
                        <span class="block text-2xl font-bold text-purple-600">{{ $enrollment->fees->count() }}</span>
                        <span class="block text-sm text-gray-600">Fee Records</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Recent Exam Results</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($enrollment->examResults->count() > 0)
                                <div class="space-y-2">
                                    @foreach($enrollment->examResults->take(3) as $result)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">{{ $result->exam->name }}</span>
                                                <span class="text-sm font-bold {{ $result->status == 'pass' ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $result->marks_obtained }}/{{ $result->total_marks }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $result->exam->exam_date->format('M d, Y') }} |
                                                Grade: {{ $result->grade ?? 'N/A' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($enrollment->examResults->count() > 3)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-sm text-primary hover:underline">View all {{ $enrollment->examResults->count() }} results</a>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No exam results found.</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Recent Fee Records</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($enrollment->fees->count() > 0)
                                <div class="space-y-2">
                                    @foreach($enrollment->fees->take(3) as $fee)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">{{ $fee->feeType->name }}</span>
                                                <span class="text-sm font-bold text-primary">${{ number_format($fee->amount, 2) }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Due: {{ $fee->due_date->format('M d, Y') }} |
                                                Status:
                                                @if($fee->status == 'paid')
                                                    <span class="text-green-600">Paid</span>
                                                @else
                                                    <span class="text-red-600">Unpaid</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($enrollment->fees->count() > 3)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-sm text-primary hover:underline">View all {{ $enrollment->fees->count() }} fees</a>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No fee records found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
