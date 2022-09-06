<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'certificate_id',
    ];

    
    public function certificate()
    {
       return $this->belongsTo(Certificate::class,'certificate_id');
    }
}
