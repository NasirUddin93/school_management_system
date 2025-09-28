@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Add New Fine</h2>

    <form action="{{ route('student-fines.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Student</label>
            <select name="student_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Fee Type</label>
            <select name="fee_type_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Fee Type</option>
                @foreach($feeTypes as $feeType)
                    <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Amount</label>
            <input type="number" step="0.01" name="amount" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Fine Date</label>
            <input type="date" name="fine_date" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Due Date</label>
            <input type="date" name="due_date" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Reason</label>
            <input type="text" name="reason" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="unpaid">Unpaid</option>
                <option value="partially_paid">Partially Paid</option>
                <option value="paid">Paid</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block">Remarks</label>
            <textarea name="remarks" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Fine
            </button>
        </div>
    </form>
</div>
@endsection
