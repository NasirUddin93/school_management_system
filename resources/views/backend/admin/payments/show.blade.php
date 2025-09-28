@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Payment Details</h1>

    <div class="bg-white p-4 rounded shadow">
        <p><strong>Student:</strong> {{ $payment->student->first_name }} {{ $payment->student->last_name }}</p>
        <p><strong>Fee Type:</strong> {{ $payment->studentFee->fee_type }}</p>
        <p><strong>Amount Paid:</strong> {{ $payment->amount_paid }}</p>
        <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
        <p><strong>Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Transaction Ref:</strong> {{ $payment->transaction_reference ?? 'N/A' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        <p><strong>Remarks:</strong> {{ $payment->remarks ?? 'None' }}</p>
    </div>

    <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">Back</a>
</div>
@endsection
