@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Student Fines</h2>
        <a href="{{ route('student-fines.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add Fine
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Student</th>
                    <th class="px-4 py-2 border">Fee Type</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fines as $fine)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $fine->student->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $fine->feeType->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ number_format($fine->amount, 2) }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-sm
                                @if($fine->status == 'paid') bg-green-100 text-green-700
                                @elseif($fine->status == 'unpaid') bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst($fine->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border flex space-x-2">
                            <a href="{{ route('student-fines.show', $fine->id) }}" class="bg-gray-200 px-2 py-1 rounded hover:bg-gray-300">View</a>
                            <a href="{{ route('student-fines.edit', $fine->id) }}" class="bg-blue-200 px-2 py-1 rounded hover:bg-blue-300">Edit</a>
                            <form action="{{ route('student-fines.destroy', $fine->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-200 px-2 py-1 rounded hover:bg-red-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $fines->links() }}
        </div>
    </div>
</div>
@endsection
