@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Student Fees</h2>
        <a href="{{ route('student-fees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Fee</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">Student</th>
                <th class="py-2 px-4 border">Fee Type</th>
                <th class="py-2 px-4 border">Amount</th>
                <th class="py-2 px-4 border">Total Amount</th>
                <th class="py-2 px-4 border">Due Date</th>
                <th class="py-2 px-4 border">Status</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($studentFees as $fee)
                <tr>
                    <td class="py-2 px-4 border">{{ $fee->student->first_name }} {{ $fee->student->last_name }}</td>
                    <td class="py-2 px-4 border">{{ $fee->feeType->name }}</td>
                    <td class="py-2 px-4 border">{{ number_format($fee->amount, 2) }}</td>
                    <td class="py-2 px-4 border">{{ number_format($fee->total_amount, 2) }}</td>
                    <td class="py-2 px-4 border">{{ $fee->due_date }}</td>
                    <td class="py-2 px-4 border">
                        <span class="capitalize">{{ $fee->status }}</span>
                    </td>
                    <td class="py-2 px-4 border flex space-x-2">
                        <a href="{{ route('student-fees.show', $fee->id) }}" class="text-blue-600">View</a>
                        <a href="{{ route('student-fees.edit', $fee->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('student-fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No student fees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $studentFees->links() }}
    </div>
</div>
@endsection
