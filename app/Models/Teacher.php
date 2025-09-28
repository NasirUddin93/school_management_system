<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
       use HasFactory, Notifiable;

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
        'password',
        'profile_picture',
        'is_active', // Add this if you want to use it
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date'
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id')
                    ->withTimestamps();
    }

    public function classSections()
    {
        return $this->belongsToMany(ClassSection::class, 'teacher_class_section', 'teacher_id', 'class_section_id')
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'teacher_id');
    }

    public function salaries()
    {
        return $this->hasMany(TeacherSalary::class, 'teacher_id');
    }

    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'teacher_id');
    }

}
