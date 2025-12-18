<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'student_name',
        'grades',
        'passed_subjects',
        'failed_subjects',
        'total',
        'overall_average',
        'overall_averageE',
        'grade',
        'academic_year'
    ];

    protected $casts = [
        'grades' => 'array', // To cast grades from JSON to an array
    ];
}
