<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
class ResultHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'section_id',
        'total_seat',
        'total_enrolled',
        'total_appeared',
        'ap',
        'a',
        'am',
        'b',
        'c',
        'd',
        'absent',
        'fail',
        'pass',
    ];
    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }

    public function getPercentageAttribute()
    {
        $percentage = (($this->pass*100)/$this->total_appeared);
        return number_format((float)$percentage, 2, '.', '');
    }
}
