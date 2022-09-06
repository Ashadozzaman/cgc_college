<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation_id',
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'address',
        'joining_date',
        'details',
        'image',
        'order_by',
        'status'
    ];

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }
}
