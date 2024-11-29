<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenGroup extends Model
{
    use HasFactory  ;
    protected $fillable = [
        'employee_id',
        'name',
    ] ;

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
