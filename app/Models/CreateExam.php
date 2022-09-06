<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
class CreateExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'session',
        'certificate',
        'status',
    ];
    public function certificate()
    {
       return $this->belongsTo(Certificate::class,'certificate_id');
    }
}
