<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;
       protected $fillable = [
        'fee_type_id',
        'class_id',
        'section_id',
        'shift_id',
        'amount',
        'effective_date',
        'status',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * FeeStructure belongs to a FeeType
     */
    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    /**
     * FeeStructure belongs to a Class
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * FeeStructure optionally belongs to a Section
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * FeeStructure optionally belongs to a Shift
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    /**
     * A fee structure can be assigned to many student fees
     */
    public function studentFees()
    {
        return $this->hasMany(StudentFee::class, 'fee_structure_id');
    }
}
