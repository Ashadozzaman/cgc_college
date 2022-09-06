<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\CreateExam;
use App\Models\Employee;
use App\Models\Subject;
class MarkSetup extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'teacher_id',
        'section_id',
        'subject_code',
        'total_mark',
        'cq',
        'mcq',
        'practical',
    ];

    
    public function exam()
    {
       return $this->belongsTo(CreateExam::class,'exam_id');
    }
    
    public function teacher()
    {
       return $this->belongsTo(Employee::class,'teacher_id','id');
    }
    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }
    public function subject()
    {
       return $this->hasOne(Subject::class,'subject_code','subject_code');
    }
}
