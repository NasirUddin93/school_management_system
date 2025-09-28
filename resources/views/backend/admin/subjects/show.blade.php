@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Subject Details: {{ $subject->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('subjects.edit', $subject->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('subjects.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Basic Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $subject->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Subject Code</span>
                                <span class="block text-gray-800">{{ $subject->code }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($subject->status == 'active')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $subject->description ?: 'No description' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Created At</span>
                                <span class="block text-gray-600">{{ $subject->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Updated At</span>
                                <span class="block text-gray-600">{{ $subject->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Assigned Teachers</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $subject->teachers->count() }}</span>
                                    <span class="text-sm text-gray-600"> teachers assigned</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Class Sections</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-green-600">{{ $subject->classSections->count() }}</span>
                                    <span class="text-sm text-gray-600"> class sections</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Exams</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-purple-600">{{ $subject->exams->count() }}</span>
                                    <span class="text-sm text-gray-600"> exams conducted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assigned Teachers</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($subject->teachers->count() > 0)
                                <div class="space-y-2">
                                    @foreach($subject->teachers as $teacher)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm font-medium text-gray-700">{{ $teacher->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No teachers assigned to this subject.</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Class Sections</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($subject->classSections->count() > 0)
                                <div class="space-y-2">
                                    @foreach($subject->classSections as $classSection)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $classSection->class->name }} - {{ $classSection->section->name }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">This subject is not assigned to any class sections.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
