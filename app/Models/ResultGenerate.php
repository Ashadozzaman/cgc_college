<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\MarkSetup;
class ResultGenerate extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'mark_setup_id',
        'subject_code',
        'student_id',
        'total_mark',
        'cq',
        'mcq',
        'practical',
        'gpa',
    ];
    public function student()
    {
       return $this->belongsTo(User::class,'student_id','student_id');
    }
    public function subject()
    {
       return $this->hasOne(Subject::class,'subject_code','subject_code');
    }
    public function marksetup()
    {
       return $this->belongsTo(MarkSetup::class,'mark_setup_id','id');
    }
}
