<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'link',
        'order_by',
        'status',
    ];
}
