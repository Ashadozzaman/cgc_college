<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSubject extends Model
{
    use HasFactory;
    protected $table="main_subjects";
    protected $fillable = [
        'name',
        'certificate',
    ];
}
