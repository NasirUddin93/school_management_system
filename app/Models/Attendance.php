<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
       protected $fillable = [
        'enrollment_id',
        'teacher_assignment_id',
        'attendance_date',
        'status',
        'remarks',
    ];
    protected $casts = [
        'attendance_date' => 'date'
    ];

    /**
     * Attendance belongs to an enrollment (student)
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    /**
     * Attendance optionally belongs to a teacher assignment
     */
    public function teacherAssignment()
    {
        return $this->belongsTo(TeacherAssignment::class, 'teacher_assignment_id');
    }

    /**
     * Through enrollment, get the student
     */
    public function student()
    {
        return $this->enrollment->student();
    }

    /**
     * Through teacher assignment, get the subject
     */
    public function subject()
    {
        return $this->teacherAssignment->subject();
    }

    /**
     * Through teacher assignment, get the class-section
     */
    public function classSection()
    {
        return $this->teacherAssignment->classSection();
    }
}
