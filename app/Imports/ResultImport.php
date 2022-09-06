<?php

namespace App\Imports;

use App\Models\ResultGenerate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Traits\Calculation;
use App\Models\MarkSetup;
class ResultImport implements WithHeadingRow,ToCollection
{
    use Calculation;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $items; 

    public function __construct(array $items = [])
    {
        $this->items = $items; 
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $data['mark_setup_id'] = $this->items['mark_setup_id'];
            $data['subject_code']  = $row['subject_code'];
            $data['exam_id']       = $this->items['exam_id'];
            $markDetails = MarkSetup::where('id',$this->items['mark_setup_id'])->first();
            $cq_pass  = $this->pass_mark($markDetails->cq);
            $mcq_pass = $this->pass_mark($markDetails->mcq);
            $practical_pass = $this->pass_mark($markDetails->practical);
            $data['student_id']  = $row['student_id'];
            $data['cq']  = $row['cq'];
            $data['mcq'] = $row['mcq'];
            $data['practical'] = $row['practical'];
            $data['total_mark'] = $row['cq'] + $row['mcq'] + $row['practical'];
            if($cq_pass > $row['cq']){
                $data['gpa'] = "0.00";
            }else if($mcq_pass > $row['mcq']){
                $data['gpa'] = "0.00";
            }else if($practical_pass > $row['practical']){
                $data['gpa'] = "0.00";
            }else{
                $data['gpa'] = $this->calculation_gpa($data['total_mark']);
            }
            // dd($data);
            ResultGenerate::where(['exam_id'=>$markDetails->exam_id,'mark_setup_id'=>$this->items['mark_setup_id'],'subject_code'=>$row['subject_code'],'student_id'=>$row['student_id']])->update($data);
            
        }
    }

    // public function model(array $row)
    // {
    //     $data['mark_setup_id'] = $this->items['mark_setup_id'];
    //     $data['subject_code']  = $this->items['subject_code'];
    //     $data['exam_id']       = $this->items['exam_id'];
    //     $markDetails = MarkSetup::where('id',$this->items['mark_setup_id'])->first();
    //     $cq_pass  = $this->pass_mark($markDetails->cq);
    //     $mcq_pass = $this->pass_mark($markDetails->mcq);
    //     $practical_pass = $this->pass_mark($markDetails->practical);
    //     $data['student_id']  = $row['student_id'];
    //     $data['cq']  = $row['cq'];
    //     $data['mcq'] = $row['mcq'];
    //     $data['practical'] = $row['practical'];
    //     $data['total_mark'] = $row['cq'] + $row['mcq'] + $row['practical'];
    //     if($cq_pass > $row['cq']){
    //         $data['gpa'] = "0.00";
    //     }else if($mcq_pass > $row['mcq']){
    //         $data['gpa'] = "0.00";
    //     }else if($practical_pass > $row['practical']){
    //         $data['gpa'] = "0.00";
    //     }else{
    //         $data['gpa'] = $this->calculation_gpa($data['total_mark']);
    //     }
    //     dd($data);

    //     return new ResultGenerate([
    //         //
    //     ]);
    // }
}
