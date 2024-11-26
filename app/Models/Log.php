<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'child_id',
        'details'
    ]; 

    public function children()
    {
        return $this->belongsTo(Children::class, 'child_id');
    } 
}
