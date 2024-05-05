<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'specialization_id',
        'user_id',
        'patient_id',
        'selected_date',
        'start_time',
        'end_time',
        'status'
    ];
}
