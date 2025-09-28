@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit Student Fee</h2>

    <form action="{{ route('student-fees.update', $studentFee->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Student</label>
            <select name="student_id" class="w-full border rounded p-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" @selected($studentFee->student_id == $student->id)>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Fee Type</label>
            <select name="fee_type_id" class="w-full border rounded p-2">
                @foreach($feeTypes as $feeType)
                    <option value="{{ $feeType->id }}" @selected($studentFee->fee_type_id == $feeType->id)>
                        {{ $feeType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ $studentFee->amount }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Late Fine</label>
            <input type="number" step="0.01" name="late_fine" value="{{ $studentFee->late_fine }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Due Date</label>
            <input type="date" name="due_date" value="{{ $studentFee->due_date }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2">
                @foreach(['unpaid', 'partially_paid', 'paid', 'overdue', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected($studentFee->status == $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
