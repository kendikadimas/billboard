<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyPerformanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_date', // Mengganti year dan month
        'total_man_hours',
        'fatality',
        'property_damage',
        'latest_accident_date',
        'total_accident_this_month',
        'man_power',
        'lost_time_injury',
        'lost_working_day',
        'medical_treatment_injury',
        'ppe_violation',
    ];

    protected $casts = [
        'record_date' => 'date', // Menambahkan casting untuk record_date
        'latest_accident_date' => 'date',
    ];
}