<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
       protected $fillable = [
        'name',
        'description',
        'exam_date',
        'class_section_id',
        'subject_id',
        'teacher_assignment_id',
        'status',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * Exam belongs to a ClassSection
     */
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }

    /**
     * Exam belongs to a Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Exam optionally belongs to a TeacherAssignment
     */
    public function teacherAssignment()
    {
        return $this->belongsTo(TeacherAssignment::class, 'teacher_assignment_id');
    }

    /**
     * Exam has many results
     */
    public function results()
    {
        return $this->hasMany(ExamResult::class, 'exam_id');
    }
}
