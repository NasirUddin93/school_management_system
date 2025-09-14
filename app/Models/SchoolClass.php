<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
    ];

    public function classSections()
    {
        return $this->hasMany(ClassSection::class, 'class_id');
    }
    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'class_id');
    }

}
