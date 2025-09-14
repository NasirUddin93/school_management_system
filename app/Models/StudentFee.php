<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
       use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_structure_id',
        'fee_type_id',
        'amount',
        'late_fine',
        'total_amount',
        'due_date',
        'paid_date',
        'status',
        'remarks',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * Each student fee belongs to a student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Each student fee may be linked to a fee structure
     */
    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class, 'fee_structure_id');
    }

    /**
     * Each student fee belongs to a specific fee type (e.g., tuition, exam, fine)
     */
    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    /**
     * A student fee can have many payments (if paid in installments)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_fee_id');
    }
}
