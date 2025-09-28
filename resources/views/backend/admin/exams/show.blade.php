@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Exam Details: {{ $exam->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('exams.edit', $exam->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('exams.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Exam Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Exam Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $exam->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $exam->description ?: 'No description' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Exam Date</span>
                                <span class="block text-gray-800">{{ $exam->exam_date->format('F d, Y') }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @php
                                    $statusColors = [
                                        'Scheduled' => 'bg-blue-100 text-blue-800',
                                        'Completed' => 'bg-green-100 text-green-800',
                                        'Cancelled' => 'bg-red-100 text-red-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$exam->status] }}">
                                    {{ $exam->status }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Created At</span>
                                <span class="block text-gray-600">{{ $exam->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Updated At</span>
                                <span class="block text-gray-600">{{ $exam->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Class & Subject Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class-Section</span>
                                <span class="block text-lg font-semibold text-gray-800">
                                    {{ $exam->classSection->class->name }} - {{ $exam->classSection->section->name }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject</span>
                                <span class="block text-gray-800">{{ $exam->subject->name }} ({{ $exam->subject->code }})</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Assigned Teacher</span>
                                @if($exam->teacherAssignment)
                                    <span class="block text-gray-800">{{ $exam->teacherAssignment->teacher->name }}</span>
                                @else
                                    <span class="block text-gray-500">Not assigned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Exam Results</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if($exam->results->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Marks</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($exam->results->take(5) as $result)
                                            <tr>
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                                    {{ $result->student->first_name }} {{ $result->student->last_name }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $result->marks_obtained }}/{{ $result->total_marks }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $result->grade ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-2 text-sm">
                                                    @if($result->status == 'pass')
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Pass</span>
                                                    @else
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Fail</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($exam->results->count() > 5)
                                <div class="mt-3 text-center">
                                    <a href="#" class="text-sm text-primary hover:underline">View all {{ $exam->results->count() }} results</a>
                                </div>
                            @endif
                        @else
                            <p class="text-sm text-gray-500">No results recorded for this exam yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
