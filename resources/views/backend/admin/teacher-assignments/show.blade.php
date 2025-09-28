@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Teacher Assignment Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('teacher-assignments.edit', $teacherAssignment->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('teacher-assignments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Teacher Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Teacher Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $teacherAssignment->teacher->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Employee ID</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->teacher->employee_id }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Email</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->teacher->email }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Phone</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->teacher->phone }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assignment Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class-Section</span>
                                <span class="block text-lg font-semibold text-gray-800">
                                    {{ $teacherAssignment->classSection->class->name }} - {{ $teacherAssignment->classSection->section->name }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Shift</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->classSection->shift->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->subject->name }} ({{ $teacherAssignment->subject->code }})</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($teacherAssignment->status == 'Active')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Attendance Records</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $teacherAssignment->attendances->count() }}</span>
                                    <span class="text-sm text-gray-600"> attendance records</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Exams Conducted</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-green-600">{{ $teacherAssignment->exams->count() }}</span>
                                    <span class="text-sm text-gray-600"> exams conducted</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assignment Timeline</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Assigned On</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->created_at->format('F d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Last Updated</span>
                                <span class="block text-gray-800">{{ $teacherAssignment->updated_at->format('F d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Recent Exams</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($teacherAssignment->exams->count() > 0)
                                <div class="space-y-2">
                                    @foreach($teacherAssignment->exams->take(3) as $exam)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">{{ $exam->name }}</span>
                                                <span class="text-xs px-2 py-1 rounded-full {{ $exam->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                    {{ $exam->status }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $exam->exam_date->format('M d, Y') }} |
                                                {{ $exam->classSection->class->name }} - {{ $exam->classSection->section->name }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($teacherAssignment->exams->count() > 3)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-sm text-primary hover:underline">View all {{ $teacherAssignment->exams->count() }} exams</a>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No exams conducted yet.</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Quick Actions</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <a href="#" class="block w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-calendar-plus mr-1"></i> Schedule Exam
                            </a>
                            <a href="#" class="block w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-clipboard-list mr-1"></i> Take Attendance
                            </a>
                            <a href="#" class="block w-full bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-tasks mr-1"></i> Create Assignment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
