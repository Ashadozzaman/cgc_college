<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['ssc_group'] == "H") {
            $section_id = 2;
        }else if($row['ssc_group'] == "B"){
            $section_id = 3;
        }else if($row['ssc_group'] == "S"){
            $section_id = 1;
        }else if($row['ssc_group'] == "D"){
            $section_id = 5;
        }else if($row['ssc_group'] == "HN"){
            $section_id = 6;
        }else{
            return 1;
        }

        if($section_id == 1){
            $roll_start = 1000;
        }else if($section_id == 2){
            $roll_start = 2000;
        }else if($section_id == 3){
            $roll_start = 3000;
        }else if($section_id == 4){
            $roll_start = 4000;
        }else if($section_id == 5){
            $roll_start = 5000;
        }
        $user = User::where('education_year',date('Y'))->where('section_id',$section_id)->where('certificate','HSC')->orderBy('student_id','desc')->first();
        if(empty($user)){
            $class_roll = $roll_start + 1;
        }else{
            $class_roll = $user->class_roll + 1;
        }
        $student_id = (int) (date('Y').$class_roll);
        $class_roll = (int) $class_roll;
        $data = [
            'role_id'        => '3',
            'full_name'      => $row['name'],
            'section_id'     => $section_id,
            'student_id'     => $student_id,
            'class_roll'     => $class_roll,
            'ssc_roll'       => $row['ssc_roll'],
            'education_year' => date('Y'),
            'certificate_id'    => $row['certificate_id'],
            'gender'         => $row['gender'],
            'ssc_board'          => $row['board'],
            'email'          => $row['ssc_roll'].'@gmail.com',
            'password'       => bcrypt($row['ssc_roll']),
        ];
        return new User($data);
    }
}
