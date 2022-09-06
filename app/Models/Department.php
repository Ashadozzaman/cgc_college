<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TeacherAssign;
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order_by',
        'status',
        'image',
        'body',
    ];
    public function teachers(){
        return $this->hasMany(TeacherAssign::class,'department_id');
    }
}
