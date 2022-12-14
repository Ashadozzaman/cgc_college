<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TeacherAssign;
use App\Models\Notice;
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
    public function notices(){
        return $this->hasMany(Notice::class,'department_id');
    }
}
