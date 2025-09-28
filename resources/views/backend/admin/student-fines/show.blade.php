@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Fine Details</h2>

    <div class="bg-white p-4 border rounded shadow">
        <p><strong>Student:</strong> {{ $fine->student->name ?? 'N/A' }}</p>
        <p><strong>Fee Type:</strong> {{ $fine->feeType->name ?? 'N/A' }}</p>
        <p><strong>Amount:</strong> {{ number_format($fine->amount, 2) }}</p>
        <p><strong>Fine Date:</strong> {{ $fine->fine_date }}</p>
        <p><strong>Due Date:</strong> {{ $fine->due_date ?? 'N/A' }}</p>
        <p><strong>Reason:</strong> {{ $fine->reason ?? 'N/A' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($fine->status) }}</p>
        <p><strong>Remarks:</strong> {{ $fine->remarks ?? 'N/A' }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('student-fines.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back</a>
    </div>
</div>
@endsection
