@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Payment</h1>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Student</label>
            <select name="student_id" class="w-full border rounded p-2" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Student Fee</label>
            <select name="student_fee_id" class="w-full border rounded p-2" required>
                @foreach($studentFees as $fee)
                    <option value="{{ $fee->id }}" {{ $payment->student_fee_id == $fee->id ? 'selected' : '' }}>
                        {{ $fee->fee_type }} - {{ $fee->amount }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Amount Paid</label>
            <input type="number" step="0.01" name="amount_paid" class="w-full border rounded p-2" value="{{ $payment->amount_paid }}" required>
        </div>

        <div>
            <label class="block mb-1">Payment Date</label>
            <input type="date" name="payment_date" class="w-full border rounded p-2" value="{{ $payment->payment_date }}" required>
        </div>

        <div>
            <label class="block mb-1">Payment Method</label>
            <select name="payment_method" class="w-full border rounded p-2" required>
                @foreach(['cash','card','mobile_banking','bank_transfer','check','other'] as $method)
                    <option value="{{ $method }}" {{ $payment->payment_method == $method ? 'selected' : '' }}>
                        {{ ucfirst($method) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Transaction Reference</label>
            <input type="text" name="transaction_reference" class="w-full border rounded p-2" value="{{ $payment->transaction_reference }}">
        </div>

        <div>
            <label class="block mb-1">Remarks</label>
            <textarea name="remarks" class="w-full border rounded p-2">{{ $payment->remarks }}</textarea>
        </div>

        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update Payment</button>
    </form>
</div>
@endsection
