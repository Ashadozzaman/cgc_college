<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'result_type',
        'published_date',
        'details',
        'file',
        'is_pdf',
        'status',
    ];
}
