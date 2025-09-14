<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'description',
    ];

    public function classSections()
    {
        return $this->hasMany(ClassSection::class, 'shift_id');
    }
    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'shift_id');
    }

}
