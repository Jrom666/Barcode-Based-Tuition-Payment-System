<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'cashier_id',
        'amount',
        'term',
        'status',
        'payment_date',
        'payment_method',
        'reference_number',
    ];
    public function student(){
        return $this->belongsTo(Student::class);
    }
    
}
