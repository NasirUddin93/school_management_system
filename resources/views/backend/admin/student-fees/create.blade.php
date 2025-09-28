@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Add Student Fee</h2>

    <form action="{{ route('student-fees.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Student</label>
            <select name="student_id" class="w-full border rounded p-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Fee Type</label>
            <select name="fee_type_id" class="w-full border rounded p-2">
                @foreach($feeTypes as $feeType)
                    <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Fee Structure (Optional)</label>
            <select name="fee_structure_id" class="w-full border rounded p-2">
                <option value="">-- None --</option>
                @foreach($feeStructures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->name }} - {{ $structure->amount }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Late Fine</label>
            <input type="number" step="0.01" name="late_fine" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Due Date</label>
            <input type="date" name="due_date" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
