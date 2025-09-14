<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_code',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'guardian_name',
        'guardian_phone',
        'address',
        'admission_date',
        'photo',
        'status',
        'class_section_id',
    ];

    /**
     * Relationship: Student belongs to a class-section
     */
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }

    /**
     * Relationship: Student enrollments (if maintaining historical enrollments)
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relationship: Student attendance records
     */
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Relationship: Exam results
     */
    // public function examResults()
    // {
    //     return $this->hasMany(ExamResult::class);
    // }

    public function examResults()
    {
        return $this->hasManyThrough(ExamResult::class, Enrollment::class, 'student_id', 'enrollment_id');
    }


    /**
     * Relationship: Fees charged to student
     */
    public function fees()
    {
        return $this->hasMany(StudentFee::class);
    }

    /**
     * Relationship: Fines for student
     */
    public function fines()
    {
        return $this->hasMany(StudentFine::class);
    }

    /**
     * Relationship: Payments made by student
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, StudentFee::class, 'student_id', 'student_fee_id');
    }
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, Enrollment::class, 'student_id', 'enrollment_id');
    }
    public function studentFees()
    {
        return $this->hasMany(StudentFee::class, 'student_id');
    }


}
