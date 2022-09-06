<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StudentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ssc_roll',
        'ssc_reg',
        'school',
        'ssc_gpa',
        'ssc_gpa_forth',
        'dob',
        'nationality',
        'father_name',
        'father_nid',
        'father_occupation',
        'mother_name',
        'mother_nid',
        'mother_occupation',
        'father_yearly_income',
        'parents_phone',
        'mother_yearly_income',
        'birth_registration',
        'marital_status',
        'religion',
        'permanent_address',
        'present_address',
        'local_guardian_name',
        'relation_local_guardian',
        'local_guardian_mobile',
        'blood_group',
    ];

    
}
