<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Student;

class ClassSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'section_id',
        'shift_id',
        'capacity',
        'description',
    ];

    /**
     * Relationship: Each class-section belongs to a class.
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Relationship: Each class-section belongs to a section.
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Relationship: Each class-section is assigned to a shift.
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    /**
     * Relationship: Students in this class-section
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'class_section_id');
    }
    public function subjects()
{
    return $this->belongsToMany(Subject::class, 'class_subjects', 'class_section_id', 'subject_id')
                ->withTimestamps();
}

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'class_section_id');
    }

    /**
     * Relationship: Teachers assigned to this class-section
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_class_section', 'class_section_id', 'teacher_id');
    }
    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'class_section_id');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'class_section_id');
    }


}
