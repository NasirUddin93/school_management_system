<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
      protected $fillable = [
        'exam_id',
        'enrollment_id',
        'subject_id',
        'marks_obtained',
        'total_marks',
        'grade',
        'is_passed',
        'remarks',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * ExamResult belongs to an Exam
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    /**
     * ExamResult belongs to an Enrollment (student record for a class-section)
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    /**
     * ExamResult belongs to a Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Get the student through enrollment
     */
    public function student()
    {
        return $this->enrollment->student();
    }

    /**
     * Get the class-section through enrollment
     */
    public function classSection()
    {
        return $this->enrollment->classSection();
    }

}
