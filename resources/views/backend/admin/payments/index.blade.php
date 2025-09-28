@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Payments List</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('payments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Payment</a>

    <table class="min-w-full mt-4 bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Student</th>
                <th class="px-4 py-2 border">Amount</th>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Method</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td class="px-4 py-2 border">{{ $payment->id }}</td>
                <td class="px-4 py-2 border">{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                <td class="px-4 py-2 border">{{ $payment->amount_paid }}</td>
                <td class="px-4 py-2 border">{{ $payment->payment_date }}</td>
                <td class="px-4 py-2 border">{{ ucfirst($payment->payment_method) }}</td>
                <td class="px-4 py-2 border">{{ ucfirst($payment->status) }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500">View</a> |
                    <a href="{{ route('payments.edit', $payment->id) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>
@endsection
