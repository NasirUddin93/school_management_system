<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'class_section_id',
        'academic_year_id',
        'roll_number',
        'enrollment_date',
        'status',
    ];

    /**
     * Enrollment belongs to a student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Enrollment belongs to a class-section
     */
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }

    /**
     * Enrollment belongs to an academic year
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    /**
     * Related attendance records for this enrollment
     */
    public function attendanceRecords()
    {
        return $this->hasMany(Attendance::class, 'enrollment_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'enrollment_id');
    }


    /**
     * Related exam results for this enrollment
     */
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'enrollment_id');
    }

    /**
     * Related fees for this enrollment
     */
    public function fees()
    {
        return $this->hasMany(StudentFee::class, 'enrollment_id');
    }
}
