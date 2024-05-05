<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','doctor_id','specialization_id','patient_id','booking_id','medicinal_prescription','medical_advices'
    ];
}
