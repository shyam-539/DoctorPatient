<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specializations');
    }

    public function qualifications()
    {
        return $this->hasMany(DoctorQualification::class);
    }

    public function images()
    {
        return $this->hasMany(DoctorImage::class);
    }

    public function slots()
    {
        return $this->belongsToMany(Slot::class);
    }

}
