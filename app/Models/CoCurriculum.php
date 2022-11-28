<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculum;
use App\Models\CurriculumImage;
class CoCurriculum extends Model
{
    use HasFactory;
    protected $fillable = [
        'curriculum_id',
        'title',
        'published_date',
        'details',
        'file',
        'status',
    ];

    public function curriculum(){
        return $this->belongsTo(Curriculum::class,"curriculum_id",'id');
    }
    public function curriculum_images(){
        return $this->hasMany(CurriculumImage::class);
    }
}
