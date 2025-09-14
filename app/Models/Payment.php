<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
      protected $fillable = [
        'student_id',
        'student_fee_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'transaction_reference',
        'status',
        'remarks',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * Payment belongs to a student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Payment belongs to a specific student fee
     */
    public function studentFee()
    {
        return $this->belongsTo(StudentFee::class, 'student_fee_id');
    }
    public function payable()
    {
        return $this->morphTo();
    }

}
