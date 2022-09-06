<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
class ServiceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'service_id',
        'body',
        'order_by',
        'image',
        'status'
    ];

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
