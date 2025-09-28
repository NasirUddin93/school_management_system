@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Fine</h2>

    <form action="{{ route('student-fines.update', $fine->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Student</label>
            <select name="student_id" class="w-full border rounded px-3 py-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $fine->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Fee Type</label>
            <select name="fee_type_id" class="w-full border rounded px-3 py-2">
                @foreach($feeTypes as $feeType)
                    <option value="{{ $feeType->id }}" {{ $fine->fee_type_id == $feeType->id ? 'selected' : '' }}>
                        {{ $feeType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ $fine->amount }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Fine Date</label>
            <input type="date" name="fine_date" value="{{ $fine->fine_date }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Due Date</label>
            <input type="date" name="due_date" value="{{ $fine->due_date }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Reason</label>
            <input type="text" name="reason" value="{{ $fine->reason }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="unpaid" {{ $fine->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="partially_paid" {{ $fine->status == 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                <option value="paid" {{ $fine->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ $fine->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block">Remarks</label>
            <textarea name="remarks" class="w-full border rounded px-3 py-2">{{ $fine->remarks }}</textarea>
        </div>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Fine
            </button>
        </div>
    </form>
</div>
@endsection
