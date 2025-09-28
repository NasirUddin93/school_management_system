@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Exam Results</h1>

    <a href="{{ route('exam-results.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Result</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 mt-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-4">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Student</th>
                    <th class="p-2 border">Subject</th>
                    <th class="p-2 border">Exam</th>
                    <th class="p-2 border">Marks</th>
                    <th class="p-2 border">Grade</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($examResults as $result)
                    <tr>
                        <td class="p-2 border">{{ $result->id }}</td>
                        <td class="p-2 border">{{ $result->enrollment->student->name ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $result->subject->name ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $result->exam->name ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $result->marks_obtained }}/{{ $result->total_marks }}</td>
                        <td class="p-2 border">{{ $result->grade }}</td>
                        <td class="p-2 border">
                            <span class="{{ $result->is_passed ? 'text-green-600' : 'text-red-600' }}">
                                {{ $result->is_passed ? 'Passed' : 'Failed' }}
                            </span>
                        </td>
                        <td class="p-2 border">
                            <a href="{{ route('exam-results.show', $result->id) }}" class="text-blue-600">View</a> |
                            <a href="{{ route('exam-results.edit', $result->id) }}" class="text-yellow-600">Edit</a> |
                            <form action="{{ route('exam-results.destroy', $result->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('Delete this result?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-2 text-center">No exam results found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $examResults->links() }}
        </div>
    </div>
</div>
@endsection
