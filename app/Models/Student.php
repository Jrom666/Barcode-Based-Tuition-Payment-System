<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';

    protected $fillable = [
        'student_number',
        'name',
        'phone',
        'email',
        'address',
        'program_id',
    ];
    

    public function program(){
        return $this->belongsTo(Program::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    
}
