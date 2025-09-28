@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Class Subject Assignment Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.class-subjects.edit', $classSubject->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.class-subjects.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Class Section Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $classSubject->classSection->class->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Section</span>
                                <span class="block text-gray-800">{{ $classSubject->classSection->section->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Shift</span>
                                <span class="block text-gray-800">{{ $classSubject->classSection->shift->name }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Capacity</span>
                                <span class="block text-gray-800">{{ $classSubject->classSection->capacity ?: 'Unlimited' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Subject Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $classSubject->subject->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject Code</span>
                                <span class="block text-gray-800">{{ $classSubject->subject->code }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($classSubject->subject->status == 'active')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $classSubject->subject->description ?: 'No description' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Assigned Teachers</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if($classSubject->classSection->teachers->count() > 0)
                            <div class="space-y-2">
                                @foreach($classSubject->classSection->teachers as $teacherAssignment)
                                    <div class="bg-white rounded-md p-3 shadow-sm">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">{{ $teacherAssignment->teacher->name }}</span>
                                                <span class="text-xs text-gray-500 block">Employee ID: {{ $teacherAssignment->teacher->employee_id }}</span>
                                            </div>
                                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                                {{ $teacherAssignment->subject->name }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No teachers assigned to this class section.</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assignment Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Assigned On</span>
                                <span class="block text-gray-600">{{ $classSubject->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Last Updated</span>
                                <span class="block text-gray-600">{{ $classSubject->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Quick Actions</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <a href="#" class="block w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> Assign Teacher
                            </a>
                            <a href="#" class="block w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-book mr-1"></i> View Syllabus
                            </a>
                            <a href="#" class="block w-full bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md text-center text-sm">
                                <i class="fas fa-tasks mr-1"></i> Manage Assignments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
