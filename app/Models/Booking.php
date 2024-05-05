<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'specialization_id',
        'user_id',
        'selected_date',
        'time',
        'status'
    ];
}
