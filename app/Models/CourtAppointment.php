<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtAppointment extends Model
{
    protected $table = 'court_appointments';
    protected $fillable = [
        'appointment_date',
        'child_id',
        'employee_id',
        'title',
        'details',
        'csf',
        'poe',
        'cola',
        'cfsc',
        'bc',
        'admission_photo',
        'latest_photo',
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
