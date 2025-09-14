<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssignment extends Model
{
    use HasFactory;
       protected $fillable = [
        'teacher_id',
        'class_section_id',
        'subject_id',
        'status',
    ];

    /**
     * Relationship: Belongs to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /**
     * Relationship: Belongs to ClassSection
     */
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }

    /**
     * Relationship: Belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'teacher_assignment_id');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_assignment_id');
    }


}
