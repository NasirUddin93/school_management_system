@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Class Section Details: {{ $classSection->class->name }} - {{ $classSection->section->name }} - {{ $classSection->shift->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('class-sections.edit', $classSection->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('class-sections.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
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
                                <span class="block text-sm font-medium text-gray-500">Class</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $classSection->class->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Section</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $classSection->section->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Shift</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $classSection->shift->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Capacity</span>
                                <span class="block text-gray-600">{{ $classSection->capacity ?: 'Unlimited' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $classSection->description ?: 'No description' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Students</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $classSection->students->count() }}</span>
                                    <span class="text-sm text-gray-600"> students enrolled</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Subjects</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-green-600">{{ $classSection->subjects->count() }}</span>
                                    <span class="text-sm text-gray-600"> subjects assigned</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Teachers</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-purple-600">{{ $classSection->teachers->count() }}</span>
                                    <span class="text-sm text-gray-600"> teachers assigned</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assigned Subjects</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($classSection->subjects->count() > 0)
                                <div class="space-y-2">
                                    @foreach($classSection->subjects as $subject)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm font-medium text-gray-700">{{ $subject->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No subjects assigned to this class section.</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Assigned Teachers</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($classSection->teachers->count() > 0)
                                <div class="space-y-2">
                                    @foreach($classSection->teachers as $teacher)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm font-medium text-gray-700">{{ $teacher->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No teachers assigned to this class section.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
