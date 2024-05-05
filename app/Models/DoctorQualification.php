<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorQualification extends Model
{
    use HasFactory;

    protected $fillable = ['qualification'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
