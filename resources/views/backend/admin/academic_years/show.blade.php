@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Academic Year Details: {{ $academicYear->year_label }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('academic-years.edit', $academicYear->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('academic-years.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
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
                                <span class="block text-sm font-medium text-gray-500">Year Label</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $academicYear->year_label }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Duration</span>
                                <span class="block text-gray-800">
                                    {{ $academicYear->start_date->format('F d, Y') }} - {{ $academicYear->end_date->format('F d, Y') }}
                                </span>
                                <span class="block text-sm text-gray-600">
                                    {{ $academicYear->start_date->diffInDays($academicYear->end_date) }} days
                                    ({{ $academicYear->start_date->diffInMonths($academicYear->end_date) }} months)
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($academicYear->status == 'Active')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Closed
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Created At</span>
                                <span class="block text-gray-600">{{ $academicYear->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Updated At</span>
                                <span class="block text-gray-600">{{ $academicYear->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Total Enrollments</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $academicYear->enrollments->count() }}</span>
                                    <span class="text-sm text-gray-600"> student enrollments</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Progress</span>
                                @php
                                    $totalDays = $academicYear->start_date->diffInDays($academicYear->end_date);
                                    $daysPassed = min(max(0, today()->diffInDays($academicYear->start_date)), $totalDays);
                                    $percentage = $totalDays > 0 ? ($daysPassed / $totalDays) * 100 : 0;
                                    $percentage = min(100, max(0, $percentage));
                                @endphp
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Academic Year Progress</span>
                                        <span class="text-sm font-bold text-primary">{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="flex justify-between items-center mt-2 text-xs text-gray-600">
                                        <span>{{ $daysPassed }} days passed</span>
                                        <span>{{ $totalDays - $daysPassed }} days remaining</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Recent Enrollments</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if($academicYear->enrollments->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Class-Section</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Roll No</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($academicYear->enrollments->take(5) as $enrollment)
                                            <tr>
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                                    {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $enrollment->classSection->class->name }} - {{ $enrollment->classSection->section->name }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $enrollment->roll_number ?: 'N/A' }}
                                                </td>
                                                <td class="px-4 py-2 text-sm">
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
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($academicYear->enrollments->count() > 5)
                                <div class="mt-3 text-center">
                                    <a href="#" class="text-sm text-primary hover:underline">View all {{ $academicYear->enrollments->count() }} enrollments</a>
                                </div>
                            @endif
                        @else
                            <p class="text-sm text-gray-500">No enrollments found for this academic year.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
