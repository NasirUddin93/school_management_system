<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFine extends Model
{
    use HasFactory;
       protected $fillable = [
        'student_id',
        'fee_type_id',
        'amount',
        'fine_date',
        'due_date',
        'reason',
        'status',
        'remarks',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * Fine belongs to a student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Fine optionally belongs to a fee type (like library fine, discipline fine)
     */
    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    /**
     * Fine may have multiple payments (installments allowed)
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
