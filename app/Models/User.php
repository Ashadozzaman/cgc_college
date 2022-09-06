<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Section;
use App\Models\StudentDetails;
use App\Models\StudentSubject;
use App\Models\Certificate;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'role_id',
        'ssc_roll',
        'education_year',
        'section_id',
        'student_id',
        'class_roll',
        'certificate',
        'phone',
        'email',
        'gender',
        'password',
        'gender',
        'ssc_board',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
       return $this->belongsTo(Role::class,'role_id');
    }

    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }
    public function subject()
    {
       return $this->hasMany(StudentSubject::class,'user_id','id');
    }
    public function details()
    {
       return $this->belongsTo(StudentDetails::class,'id','user_id');
    }
    public function certificate()
    {
       return $this->belongsTo(Certificate::class,'certificate_id','id');
    }
}
