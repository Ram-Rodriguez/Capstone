<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalAppointment extends Model
{
    protected $table = 'medical_appointments';
    protected $fillable = [
        'appointment_date',
        'child_id',
        'employee_id',
        'title',
        'details'
    ];
    protected $casts = [
        'appointment_date' => 'datetime'
    ];

    public function children()
    {
        return $this->belongsTo(Children::class, 'child_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
