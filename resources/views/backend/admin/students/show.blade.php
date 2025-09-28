@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Student Details: {{ $student->first_name }} {{ $student->last_name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('students.edit', $student->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('students.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Student Photo -->
                    <div class="flex justify-center">
                        <div class="h-32 w-32 rounded-full overflow-hidden bg-gray-200 border-4 border-white shadow-lg">
                            @if($student->photo)
                                <img src="{{ Storage::url($student->photo) }}" alt="{{ $student->first_name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-300">
                                    <i class="fas fa-user text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Student Info -->
                    <div class="md:col-span-2">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $student->first_name }} {{ $student->last_name }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Student Code</span>
                                <span class="block text-gray-800">{{ $student->student_code }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Gender</span>
                                <span class="block text-gray-800 capitalize">{{ $student->gender }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Date of Birth</span>
                                <span class="block text-gray-800">{{ \Carbon\Carbon::parse($student->dob)->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Age</span>
                                <span class="block text-gray-800">{{ \Carbon\Carbon::parse($student->dob)->age }} years</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Class Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Class Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($student->classSection)
                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Class</span>
                                    <span class="block text-lg font-semibold text-gray-800">{{ $student->classSection->class->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Section</span>
                                    <span class="block text-gray-800">{{ $student->classSection->section->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Shift</span>
                                    <span class="block text-gray-800">{{ $student->classSection->shift->name }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Admission Date</span>
                                    <span class="block text-gray-800">{{ \Carbon\Carbon::parse($student->admission_date)->format('M d, Y') }}</span>
                                </div>
                            @else
                                <p class="text-sm text-red-500">Not assigned to any class section</p>
                            @endif
                        </div>
                    </div>

                    <!-- Guardian Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Guardian Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Guardian Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $student->guardian_name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Phone Number</span>
                                <span class="block text-gray-800">{{ $student->guardian_phone }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Address</span>
                                <span class="block text-gray-800">{{ $student->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Status -->
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Status</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-100 text-green-800',
                                    'inactive' => 'bg-gray-100 text-gray-800',
                                    'graduated' => 'bg-blue-100 text-blue-800',
                                    'transferred' => 'bg-yellow-100 text-yellow-800'
                                ];
                            @endphp
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$student->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="md:col-span-2">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-blue-50 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold text-blue-600">{{ $student->enrollments->count() }}</span>
                                <span class="block text-sm text-gray-600">Enrollments</span>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold text-green-600">{{ $student->attendances->count() }}</span>
                                <span class="block text-sm text-gray-600">Attendance</span>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold text-purple-600">{{ $student->studentFees->count() }}</span>
                                <span class="block text-sm text-gray-600">Fee Records</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
