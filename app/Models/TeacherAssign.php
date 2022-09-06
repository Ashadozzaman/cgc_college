<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Employee;
class TeacherAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'teacher_id',
        'is_department_head',
    ];

    public function teacher()
    {
       return $this->belongsTo(Employee::class,'teacher_id','id');
    }

    public function department()
    {
       return $this->belongsTo(Department::class,'department_id','id');
    }
}
