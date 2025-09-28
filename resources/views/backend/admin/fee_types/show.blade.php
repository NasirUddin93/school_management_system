@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Fee Type Details: {{ $feeType->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.fee_types.edit', $feeType->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.fee_types.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
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
                                <span class="block text-sm font-medium text-gray-500">Fee Type Name</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $feeType->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Description</span>
                                <span class="block text-gray-600">{{ $feeType->description ?: 'No description' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Recurrence</span>
                                @php
                                    $recurrenceLabels = [
                                        'one_time' => 'One Time',
                                        'monthly' => 'Monthly',
                                        'yearly' => 'Yearly',
                                        'occasionally' => 'Occasionally'
                                    ];
                                    $recurrenceColors = [
                                        'one_time' => 'bg-blue-100 text-blue-800',
                                        'monthly' => 'bg-green-100 text-green-800',
                                        'yearly' => 'bg-purple-100 text-purple-800',
                                        'occasionally' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $recurrenceColors[$feeType->recurrence] }}">
                                    {{ $recurrenceLabels[$feeType->recurrence] }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Default Amount</span>
                                <span class="block text-xl font-bold text-primary">${{ number_format($feeType->default_amount, 2) }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($feeType->status == 'active')
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
                                <span class="block text-sm font-medium text-gray-500">Created At</span>
                                <span class="block text-gray-600">{{ $feeType->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Updated At</span>
                                <span class="block text-gray-600">{{ $feeType->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Student Fees</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $feeType->studentFees->count() }}</span>
                                    <span class="text-sm text-gray-600"> student fee records</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Fee Structures</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-green-600">{{ $feeType->feeStructures->count() }}</span>
                                    <span class="text-sm text-gray-600"> fee structures</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-500 mb-2">Student Fines</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-purple-600">{{ $feeType->studentFines->count() }}</span>
                                    <span class="text-sm text-gray-600"> student fines</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Recent Student Fees</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($feeType->studentFees->count() > 0)
                                <div class="space-y-2">
                                    @foreach($feeType->studentFees->take(5) as $studentFee)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">{{ $studentFee->student->first_name }} {{ $studentFee->student->last_name }}</span>
                                                <span class="text-sm font-bold text-primary">${{ number_format($studentFee->amount, 2) }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Due: {{ $studentFee->due_date->format('M d, Y') }} |
                                                Status:
                                                @if($studentFee->status == 'paid')
                                                    <span class="text-green-600">Paid</span>
                                                @else
                                                    <span class="text-red-600">Unpaid</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($feeType->studentFees->count() > 5)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-sm text-primary hover:underline">View all {{ $feeType->studentFees->count() }} records</a>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No student fee records found for this fee type.</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Fee Structures</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($feeType->feeStructures->count() > 0)
                                <div class="space-y-2">
                                    @foreach($feeType->feeStructures->take(5) as $feeStructure)
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">
                                                    {{ $feeStructure->class->name }} - {{ $feeStructure->section->name }}
                                                </span>
                                                <span class="text-sm font-bold text-primary">${{ number_format($feeStructure->amount, 2) }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Academic Year: {{ $feeStructure->academic_year }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($feeType->feeStructures->count() > 5)
                                    <div class="mt-3 text-center">
                                        <a href="#" class="text-sm text-primary hover:underline">View all {{ $feeType->feeStructures->count() }} structures</a>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No fee structures found for this fee type.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
