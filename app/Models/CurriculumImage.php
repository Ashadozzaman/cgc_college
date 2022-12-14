<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'co_curriculum_id',
        'image'
    ];
}
