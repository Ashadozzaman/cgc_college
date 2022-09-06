<?php
namespace App\Http\Traits;
use App\Models\Student;
trait Calculation {
    public function calculation_gpa($total_number) {
        if ($total_number > 79) {
            $gpa = 5.00;
        }else if($total_number > 69){
            $gpa = 4.00;
        }else if($total_number > 59){
            $gpa = 3.50;
        }else if($total_number > 49){
            $gpa = 3.00;
        }else if($total_number > 39){
            $gpa = 2.00;
        }else if($total_number > 32){
            $gpa = 1.00;
        }else{
            $gpa = 0.00;
        }
        return $gpa;
    }

    public function pass_mark($number){
        $pass = ($number * 33)/100;
        if($pass == 16.5){
            $pass = 16;
        }
        return (int)round($pass);
    }
}