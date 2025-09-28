@extends('backend.admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Exam Result</h1>

    <form action="{{ route('exam-results.update', $examResult->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Exam</label>
            <select name="exam_id" class="w-full border p-2">
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}" {{ $exam->id == $examResult->exam_id ? 'selected' : '' }}>
                        {{ $exam->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Student</label>
            <select name="enrollment_id" class="w-full border p-2">
                @foreach($enrollments as $enroll)
                    <option value="{{ $enroll->id }}" {{ $enroll->id == $examResult->enrollment_id ? 'selected' : '' }}>
                        {{ $enroll->student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Subject</label>
            <select name="subject_id" class="w-full border p-2">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $examResult->subject_id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Marks Obtained</label>
            <input type="number" name="marks_obtained" value="{{ $examResult->marks_obtained }}" step="0.01" class="w-full border p-2">
        </div>

        <div>
            <label class="block">Total Marks</label>
            <input type="number" name="total_marks" value="{{ $examResult->total_marks }}" step="0.01" class="w-full border p-2">
        </div>

        <div>
            <label class="block">Remarks</label>
            <textarea name="remarks" class="w-full border p-2">{{ $examResult->remarks }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
