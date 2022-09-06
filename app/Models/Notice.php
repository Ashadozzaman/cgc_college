<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Department;
class Notice extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'title',
        'notice_by',
        'published_date',
        'details',
        'file',
        'is_pdf',
        'status',
    ];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}
