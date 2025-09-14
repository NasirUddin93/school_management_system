<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
     /**
     * Table name
     */
    protected $table = 'teachers';

    /**
     * Fillable columns for mass assignment
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'qualification',
        'specialization',
        'joining_date',
        'address',
        'city',
        'state',
        'zip',
        'is_active',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * A teacher can teach multiple subjects
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id')
                    ->withTimestamps();
    }

    /**
     * A teacher can be assigned to many class sections
     */
    public function classSections()
    {
        return $this->belongsToMany(ClassSection::class, 'teacher_class_section', 'teacher_id', 'class_section_id')
                    ->withTimestamps();
    }

    /**
     * A teacher has many attendance records
     */
    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'teacher_id');
    }

    /**
     * A teacher can have many salary records
     */
    public function salaries()
    {
        return $this->hasMany(TeacherSalary::class, 'teacher_id');
    }
    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'teacher_id');
    }

}
