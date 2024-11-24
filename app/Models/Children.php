<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Children extends Model
{
    use HasFactory  ;
    protected $table = 'childrens';
    protected $fillable = [
        'children_group_id',
        'doa',
        'is_foundling',
        'first_name',
        'middle_name',
        'lastname',
        'blood_type',
        'age',
        'height',
        'weight',
        'dob',
        'father_name',
        'mother_name',
        'guardian_name',
        'csf',
        'poe',
        'cof',
        'cola',
        'cfsc',
        'bc',
        'admission_photo',
        'latest_photo',
        'notes',
        'is_archived'
    ];  

    public function childrenGroup()
    {
        return $this->belongsTo(ChildrenGroup::class, 'children_group_id');
    }    
}
