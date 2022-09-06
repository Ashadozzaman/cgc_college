<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'published_date',
        'details',
        'file',
        'is_pdf',
        'status',
    ];
}
