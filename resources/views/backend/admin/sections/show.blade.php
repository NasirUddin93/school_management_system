@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Section Details: {{ $section->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('sections.edit', $section->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('sections.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
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
                                <span class="block text-sm font-medium text-gray-500">Section Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $section->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $section->description ?: 'No description' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Created At</span>
                                <span class="block text-gray-600">{{ $section->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Updated At</span>
                                <span class="block text-gray-600">{{ $section->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Relationships</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Class Sections ({{ $section->classSections->count() }})</span>
                                @if($section->classSections->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($section->classSections as $classSection)
                                            <div class="bg-white rounded-md p-2 shadow-sm">
                                                <span class="text-sm font-medium text-gray-700">{{ $classSection->class->name }} - {{ $classSection->section->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">No class sections assigned.</p>
                                @endif
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Fee Structures ({{ $section->feeStructures->count() }})</span>
                                @if($section->feeStructures->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($section->feeStructures as $fee)
                                            <div class="bg-white rounded-md p-2 shadow-sm">
                                                <span class="text-sm font-medium text-gray-700">{{ $fee->fee_type }}: ${{ number_format($fee->amount, 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">No fee structures defined.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
