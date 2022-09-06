<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;

class StudentSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'user_id',
        'student_id',
        'subject_code',
    ];
    public function details()
    {
       return $this->belongsTo(Subject::class,'subject_id');
    }
    public function students()
    {
       return $this->hasMany(User::class,'user_id');
    }
}
