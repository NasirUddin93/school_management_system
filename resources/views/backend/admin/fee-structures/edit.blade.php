@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Edit Fee Structure</h2>
            </div>

            <form action="{{ route('admin.fee-structures.update', $feeStructure->id) }}" method="POST" class="px-6 py-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="fee_type_id" class="block text-sm font-medium text-gray-700 mb-1">Fee Type *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('fee_type_id') border-red-500 @enderror"
                        id="fee_type_id" name="fee_type_id" required>
                        <option value="">Select Fee Type</option>
                        @foreach($feeTypes as $feeType)
                            <option value="{{ $feeType->id }}" {{ old('fee_type_id', $feeStructure->fee_type_id) == $feeType->id ? 'selected' : '' }}>
                                {{ $feeType->name }} ({{ $feeType->recurrence }})
                            </option>
                        @endforeach
                    </select>
                    @error('fee_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Class *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_id') border-red-500 @enderror"
                            id="class_id" name="class_id" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id', $feeStructure->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="section_id" class="block text-sm font-medium text-gray-700 mb-1">Section (Optional)</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('section_id') border-red-500 @enderror"
                            id="section_id" name="section_id">
                            <option value="">Select Section (Optional)</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $feeStructure->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="shift_id" class="block text-sm font-medium text-gray-700 mb-1">Shift (Optional)</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shift_id') border-red-500 @enderror"
                            id="shift_id" name="shift_id">
                            <option value="">Select Shift (Optional)</option>
                            @foreach($shifts as $shift)
                                <option value="{{ $shift->id }}" {{ old('shift_id', $feeStructure->shift_id) == $shift->id ? 'selected' : '' }}>
                                    {{ $shift->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('shift_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount *</label>
                        <input type="number" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror"
                            id="amount" name="amount" value="{{ old('amount', $feeStructure->amount) }}" required placeholder="0.00">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="effective_date" class="block text-sm font-medium text-gray-700 mb-1">Effective Date *</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('effective_date') border-red-500 @enderror"
                            id="effective_date" name="effective_date" value="{{ old('effective_date', $feeStructure->effective_date->format('Y-m-d')) }}" required>
                        @error('effective_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                            id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status', $feeStructure->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $feeStructure->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('fee-structures.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-save mr-1"></i> Update Fee Structure
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
