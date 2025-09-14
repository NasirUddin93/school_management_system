<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    use HasFactory;
      protected $fillable = [
        'name',
        'description',
        'recurrence',
        'default_amount',
        'status',
    ];

    /* ===================================================
     * Relationships
     * =================================================== */

    /**
     * Fee type has many student fee records
     */
    public function studentFees()
    {
        return $this->hasMany(StudentFee::class, 'fee_type_id');
    }
    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'fee_type_id');
    }
    public function studentFines(){
        return $this->hasMany(StudentFine::class,'fee_type_id');
    }


}
