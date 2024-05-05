<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    use HasFactory;
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function images()
    {
        return $this->hasMany(DoctorImage::class, 'doctor_id', 'doctor_id');
    }
}
