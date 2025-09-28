@extends('backend.admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Bulk Attendance Entry</h2>
                <p class="text-sm text-gray-600">Record attendance for multiple students at once</p>
            </div>

            <form action="{{ route('attendances.bulk.store') }}" method="POST" class="px-6 py-4" id="bulk-attendance-form">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label for="class_section_id" class="block text-sm font-medium text-gray-700 mb-1">Class-Section *</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_section_id') border-red-500 @enderror"
                            id="class_section_id" name="class_section_id" required>
                            <option value="">Select Class-Section</option>
                            @foreach($classSections as $classSection)
                                <option value="{{ $classSection->id }}" {{ old('class_section_id') == $classSection->id ? 'selected' : '' }}>
                                    {{ $classSection->class->name }} - {{ $classSection->section->name }} ({{ $classSection->shift->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('class_section_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="teacher_assignment_id" class="block text-sm font-medium text-gray-700 mb-1">Teacher/Subject (Optional)</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('teacher_assignment_id') border-red-500 @enderror"
                            id="teacher_assignment_id" name="teacher_assignment_id">
                            <option value="">Select Teacher/Subject (Optional)</option>
                            @foreach($teacherAssignments as $assignment)
                                <option value="{{ $assignment->id }}" {{ old('teacher_assignment_id') == $assignment->id ? 'selected' : '' }}>
                                    {{ $assignment->teacher->name }} - {{ $assignment->subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_assignment_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="attendance_date" class="block text-sm font-medium text-gray-700 mb-1">Date *</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('attendance_date') border-red-500 @enderror"
                            id="attendance_date" name="attendance_date" value="{{ old('attendance_date', date('Y-m-d')) }}" required max="{{ date('Y-m-d') }}">
                        @error('attendance_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Students List -->
                <div id="students-container" class="mb-6 hidden">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Students Attendance</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Roll No</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student Name</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="students-list" class="divide-y divide-gray-200">
                                    <!-- Students will be loaded here via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-6 hidden" id="quick-actions">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Quick Actions</h3>
                    <div class="flex space-x-2">
                        <button type="button" id="mark-all-present" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-check-circle mr-1"></i> Mark All Present
                        </button>
                        <button type="button" id="mark-all-absent" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-times-circle mr-1"></i> Mark All Absent
                        </button>
                        <button type="button" id="clear-all" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-undo mr-1"></i> Clear All
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('attendances.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit" id="submit-button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md hidden">
                        <i class="fas fa-save mr-1"></i> Save All Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const classSectionSelect = document.getElementById('class_section_id');
    const studentsContainer = document.getElementById('students-container');
    const studentsList = document.getElementById('students-list');
    const quickActions = document.getElementById('quick-actions');
    const submitButton = document.getElementById('submit-button');
    const markAllPresent = document.getElementById('mark-all-present');
    const markAllAbsent = document.getElementById('mark-all-absent');
    const clearAll = document.getElementById('clear-all');

    classSectionSelect.addEventListener('change', function() {
        const classSectionId = this.value;

        if (classSectionId) {
            fetchStudents(classSectionId);
        } else {
            hideStudentsContainer();
        }
    });

    function fetchStudents(classSectionId) {
        // Show loading state
        studentsList.innerHTML = `
            <tr>
                <td colspan="4" class="px-4 py-4 text-center">
                    <div class="flex justify-center items-center">
                        <i class="fas fa-spinner fa-spin text-blue-500 mr-2"></i>
                        <span>Loading students...</span>
                    </div>
                </td>
            </tr>
        `;

        studentsContainer.classList.remove('hidden');
        quickActions.classList.remove('hidden');

        fetch(`/admin/class-sections/${classSectionId}/students`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.students.length > 0) {
                    renderStudentsList(data.students);
                    submitButton.classList.remove('hidden');
                } else {
                    studentsList.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                No students found in this class section.
                            </td>
                        </tr>
                    `;
                    submitButton.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error fetching students:', error);
                studentsList.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-red-500">
                            Error loading students. Please try again.
                        </td>
                    </tr>
                `;
                submitButton.classList.add('hidden');
            });
    }

    function renderStudentsList(students) {
        studentsList.innerHTML = '';

        students.forEach((student, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-2">
                    <span class="text-sm font-medium text-gray-900">${student.roll_number || 'N/A'}</span>
                    <input type="hidden" name="attendances[${index}][enrollment_id]" value="${student.id}">
                </td>
                <td class="px-4 py-2">
                    <span class="text-sm text-gray-900">${student.student.first_name} ${student.student.last_name}</span>
                </td>
                <td class="px-4 py-2">
                    <select name="attendances[${index}][status]" class="attendance-status w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                        <option value="Present" selected>Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Late">Late</option>
                        <option value="Excused">Excused</option>
                    </select>
                </td>
                <td class="px-4 py-2">
                    <input type="text" name="attendances[${index}][remarks]"
                           class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm"
                           placeholder="Optional remarks" maxlength="255">
                </td>
            `;
            studentsList.appendChild(row);
        });
    }

    function hideStudentsContainer() {
        studentsContainer.classList.add('hidden');
        quickActions.classList.add('hidden');
        submitButton.classList.add('hidden');
        studentsList.innerHTML = '';
    }

    // Quick actions
    markAllPresent.addEventListener('click', function() {
        document.querySelectorAll('.attendance-status').forEach(select => {
            select.value = 'Present';
        });
    });

    markAllAbsent.addEventListener('click', function() {
        document.querySelectorAll('.attendance-status').forEach(select => {
            select.value = 'Absent';
        });
    });

    clearAll.addEventListener('click', function() {
        document.querySelectorAll('.attendance-status').forEach(select => {
            select.value = 'Present';
        });
        document.querySelectorAll('input[name$="[remarks]"]').forEach(input => {
            input.value = '';
        });
    });

    // Form validation
    document.getElementById('bulk-attendance-form').addEventListener('submit', function(e) {
        const classSectionId = document.getElementById('class_section_id').value;
        const attendanceDate = document.getElementById('attendance_date').value;

        if (!classSectionId || !attendanceDate) {
            e.preventDefault();
            alert('Please select a class section and date before submitting.');
            return false;
        }

        // Show loading state
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...';
        submitButton.disabled = true;
    });
});

// Mock function for fetching students - you'll need to implement the actual endpoint
function fetchStudents(classSectionId) {
    // This is a mock implementation. You'll need to create a controller method
    // that returns students for a given class section

    // For now, we'll simulate a delay and show mock data
    setTimeout(() => {
        const mockStudents = [
            {
                id: 1,
                roll_number: 1,
                student: {
                    first_name: 'John',
                    last_name: 'Doe'
                }
            },
            {
                id: 2,
                roll_number: 2,
                student: {
                    first_name: 'Jane',
                    last_name: 'Smith'
                }
            },
            {
                id: 3,
                roll_number: 3,
                student: {
                    first_name: 'Michael',
                    last_name: 'Johnson'
                }
            }
        ];

        renderStudentsList(mockStudents);
        document.getElementById('submit-button').classList.remove('hidden');
    }, 1000);
}
</script>
@endpush
