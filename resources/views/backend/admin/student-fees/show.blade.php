@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">View Student Fee</h2>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Student:</strong> {{ $studentFee->student->first_name }} {{ $studentFee->student->last_name }}</p>
        <p><strong>Fee Type:</strong> {{ $studentFee->feeType->name }}</p>
        <p><strong>Amount:</strong> {{ number_format($studentFee->amount, 2) }}</p>
        <p><strong>Late Fine:</strong> {{ number_format($studentFee->late_fine, 2) }}</p>
        <p><strong>Total Amount:</strong> {{ number_format($studentFee->total_amount, 2) }}</p>
        <p><strong>Due Date:</strong> {{ $studentFee->due_date }}</p>
        <p><strong>Status:</strong> <span class="capitalize">{{ $studentFee->status }}</span></p>
        <p><strong>Remarks:</strong> {{ $studentFee->remarks ?? 'N/A' }}</p>

        <a href="{{ route('student-fees.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection
