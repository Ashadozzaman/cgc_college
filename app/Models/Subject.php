<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MainSubject;
use App\Models\Section;
use App\Models\Certificate;
class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'main_subject_id',
        'section_id',
        'certificate_id',
        'subject_code',
        'subject_status',
        'order_by',
        // 'is_cq',
        // 'cq_exam_mark',
        // 'cq_pass_mark',
        // 'is_mcq',
        // 'mcq_exam_mark',
        // 'mcq_pass_mark',
        // 'is_practical',
        // 'practical_exam_mark',
        // 'practical_pass_mark',
        // 'total_mark',
    ];
    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }
    public function main_subject()
    {
       return $this->belongsTo(MainSubject::class,'main_subject_id');
    }
    public function certificate()
    {
       return $this->belongsTo(Certificate::class,'certificate_id');
    }
}
