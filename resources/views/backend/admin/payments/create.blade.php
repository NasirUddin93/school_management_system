@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Payment</h1>

    <form action="{{ route('payments.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Student</label>
            <select name="student_id" class="w-full border rounded p-2" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Student Fee</label>
            <select name="student_fee_id" class="w-full border rounded p-2" required>
                <option value="">-- Select Fee --</option>
                @foreach($studentFees as $fee)
                    <option value="{{ $fee->id }}">{{ $fee->fee_type }} - {{ $fee->amount }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Amount Paid</label>
            <input type="number" step="0.01" name="amount_paid" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Payment Date</label>
            <input type="date" name="payment_date" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Payment Method</label>
            <select name="payment_method" class="w-full border rounded p-2" required>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="mobile_banking">Mobile Banking</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="check">Check</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Transaction Reference</label>
            <input type="text" name="transaction_reference" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Remarks</label>
            <textarea name="remarks" class="w-full border rounded p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Payment</button>
    </form>
</div>
@endsection
