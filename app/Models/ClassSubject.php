<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;
        protected $fillable = [
        'class_section_id',
        'subject_id',
    ];

    /**
     * Belongs to a ClassSection
     */
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }

    /**
     * Belongs to a Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
