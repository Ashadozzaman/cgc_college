<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ServiceCategory;
class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'order_by',
        'image',
        'status'
    ];
    public function service_categories()
    {
       return $this->hasMany(ServiceCategory::class,'service_id');
    }

}
