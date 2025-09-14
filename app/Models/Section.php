<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function classSections()
    {
        return $this->hasMany(ClassSection::class, 'section_id');
    }
    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'section_id');
    }

}
