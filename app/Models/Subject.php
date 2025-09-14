<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
       protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * A subject can be assigned to many teachers
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject', 'subject_id', 'teacher_id')
                    ->withTimestamps();
    }

    /**
     * A subject can be linked to many class sections
     */
    public function classSections()
    {
        return $this->belongsToMany(ClassSection::class, 'class_section_subject', 'subject_id', 'class_section_id')
                    ->withTimestamps();
    }

    /**
     * Exam results for this subject
     */
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'subject_id');
    }
    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'subject_id');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'subject_id');
    }


}
