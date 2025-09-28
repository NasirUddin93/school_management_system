@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Fee Structure Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('fee-structures.edit', $feeStructure->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('fee-structures.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Fee Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Fee Type</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $feeStructure->feeType->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Recurrence</span>
                                <span class="block text-gray-800 capitalize">{{ $feeStructure->feeType->recurrence }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Amount</span>
                                <span class="block text-xl font-bold text-primary">${{ number_format($feeStructure->amount, 2) }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Default Amount</span>
                                <span class="block text-gray-600">${{ number_format($feeStructure->feeType->default_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Applicability</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Class</span>
                                <span class="block text-lg font-semibold text-gray-800">{{ $feeStructure->class->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Section</span>
                                <span class="block text-gray-800">{{ $feeStructure->section ? $feeStructure->section->name : 'All Sections' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Shift</span>
                                <span class="block text-gray-800">{{ $feeStructure->shift ? $feeStructure->shift->name : 'All Shifts' }}</span>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Status</span>
                                @if($feeStructure->status == 'active')
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
                        <h3 class="text-md font-medium text-gray-700 mb-3">Effective Dates</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Effective Date</span>
                                {{-- <span class="block text-gray-800">{{ $feeStructure->effective_date->format('F d, Y') }}</span> --}}
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-500">Days Since Effective</span>
                                {{-- <span class="block text-gray-800">{{ $feeStructure->effective_date->diffInDays(now()) }} days</span> --}}
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Statistics</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Student Fees</span>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600">{{ $feeStructure->studentFees->count() }}</span>
                                    <span class="text-sm text-gray-600"> student fee records</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Recent Student Fees</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if($feeStructure->studentFees->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($feeStructure->studentFees->take(5) as $studentFee)
                                            <tr>
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                                    {{ $studentFee->student->first_name }} {{ $studentFee->student->last_name }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    ${{ number_format($studentFee->amount, 2) }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $studentFee->due_date->format('M d, Y') }}
                                                </td>
                                                <td class="px-4 py-2 text-sm">
                                                    @if($studentFee->status == 'paid')
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                                    @else
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Unpaid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($feeStructure->studentFees->count() > 5)
                                <div class="mt-3 text-center">
                                    <a href="#" class="text-sm text-primary hover:underline">View all {{ $feeStructure->studentFees->count() }} student fees</a>
                                </div>
                            @endif
                        @else
                            <p class="text-sm text-gray-500">No student fees found for this fee structure.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
