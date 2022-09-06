<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Section;
use App\Models\StudentDetails;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Models\Certificate;
use App\Models\CreateExam;
use App\Models\MarkSetup;
use App\Models\ResultGenerate;
use App\Http\Traits\Calculation;
use App\Models\MainSubject;

class DashboardController extends Controller
{
    use Calculation;//trait
    public function index(){
        //dd(auth()->user());
        return view('front.index');
    }

    public function profile(){
        $id = Auth::user()->id;
        $data['sections'] = Section::get();
        $data['student'] = User::findOrFail($id);
        $data['certificates'] = Certificate::get();
        return view('front.user.profile',$data);
    }

    public function profile_update(Request $request,$id){
        if(Auth::user()->id != $id){
            return redirect()->back();
        }
        $validated = $request->validate([
            'email' => 'unique:users,email,'.$id,
            'phone' => 'required',
            'ssc_reg' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'parents_phone' => 'required',
            'birth_registration' => 'required',
            'permanent_address' => 'required',
        ]);
        if($request->password){
            $validated = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        $user = User::findOrFail($id);
        $stDetails = StudentDetails::where('user_id',$id)->first();
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\front\images\user'); 
            
            $img = Image::make($image->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.'/'.$imageName);

            // $image->move($path,$imageName);
            $data['image'] = $imageName;

            if (isset($user->image)) {
                $public_path = public_path().'/assets/front/images/user/'.$user->image;
                // dd($public_path);
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }
        $data['status'] = 1;
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        
        $details_data['ssc_reg'] = $request->ssc_reg;
        $details_data['school']  = $request->school;
        $details_data['ssc_gpa'] = $request->ssc_gpa;
        $details_data['ssc_gpa_forth'] = $request->ssc_gpa_forth;
        $details_data['dob']         = $request->dob;
        $details_data['nationality'] = $request->nationality;
        $details_data['father_name'] = $request->father_name;
        $details_data['father_nid']  = $request->father_nid;
        $details_data['father_occupation'] = $request->father_occupation;
        $details_data['mother_name'] = $request->mother_name;
        $details_data['mother_nid']  = $request->mother_nid;
        $details_data['mother_occupation']    = $request->mother_occupation;
        $details_data['father_yearly_income'] = $request->father_yearly_income;
        $details_data['parents_phone']        = $request->parents_phone;
        $details_data['mother_yearly_income'] = $request->mother_yearly_income;
        $details_data['birth_registration']   = $request->birth_registration;
        $details_data['marital_status']       = $request->marital_status;
        $details_data['religion']             = $request->religion;
        $details_data['permanent_address']    = $request->permanent_address;
        $details_data['present_address']      = $request->present_address;
        $details_data['local_guardian_name']  = $request->local_guardian_name;
        $details_data['relation_local_guardian'] = $request->relation_local_guardian;
        $details_data['local_guardian_mobile']   = $request->local_guardian_mobile;
        $details_data['blood_group']             = $request->blood_group;

        $stDetails->update($details_data);
        $user->update($data);
        return redirect()->back()->with('success','Information updated!!');
        

    }

    public function print_adminssion_form($id){
        $data['certificates'] = Certificate::get();
        $data['sections'] = Section::get();
        $data['student']  = User::findOrFail($id);
        $student  = User::findOrFail($id);
        $section_id = $student->section_id;
        $main_subject = array();
        $i = 0;
        foreach ($student->subject->sortBy('id') as $value) {
            if(!in_array($value->details->main_subject->name,$main_subject)){
                $main_subject[$i] = $value->details->main_subject->name;
                $i = $i + 1;
            }
        }
        $data['main_subjects']  = $main_subject;
        $chosseSubject = array();
        foreach ($student->subject as $k => $val) {
            $chosseSubject[$k] = $val->subject_id;
        }
        $data['choose_subjects'] = $chosseSubject;
        $subjects = Subject::select('subject_status')->groupBy('subject_status')->get();
        
        $subjects_array = array();
        foreach($subjects as $key => $value){
            $sub_subjects = array();
            if($value->subject_status == 'Elective'){
                $i = 2;
                $subjects_array[$i]['title'] = 'নৈর্বাচনিক';
                $subjects_array[$i]['limit_subject'] = 1;
                if($section_id == 2){
                    $subjects_array[$i]['limit_subject'] = 3;
                }
            }else if($value->subject_status == '4th'){
                $i = 3;
                $subjects_array[$i]['title'] = '৪র্থ ঐচ্ছিক ';
                $subjects_array[$i]['limit_subject'] = 1;
            }else if($value->subject_status == 'Compulsory'){
                $i = 1;
                $subjects_array[$i]['title'] = 'আবশ্যিক';
                $subjects_array[$i]['limit_subject'] = 5;
                if($section_id == 2){
                    $subjects_array[$i]['limit_subject'] = 3;
                }
            }

            $subjects_array[$i]['name'] = $value->subject_status;
            $subjects_sub = Subject::where('section_id',$section_id)->where('subject_status',$value->subject_status)->get();
            if($value->subject_status === 'Compulsory'){ 
                $compulsory = Subject::where('section_id',4)->where('subject_status',$value->subject_status)->get();
                $subjects_sub = array_merge(json_decode(json_encode($compulsory,true)),json_decode(json_encode($subjects_sub,true)));
                // echo "<pre>";print_r($subjects_sub);echo "</pre>";die();
            }
            foreach($subjects_sub as $key1 => $val){
                $sub_subjects[$key1]['id'] = $val->id;
                $sub_subjects[$key1]['name'] = $val->name;
                $sub_subjects[$key1]['section_id'] = $val->section_id;
                $sub_subjects[$key1]['main_subject_id'] = $val->main_subject_id;
                $sub_subjects[$key1]['subject_code'] = $val->subject_code;
                $sub_subjects[$key1]['lavel'] = $val->certificate_id;
                $sub_subjects[$key1]['subject_status'] = $val->subject_status;
                $subjects_array[$i]['sub_subjects']= $sub_subjects;
            }
        }
        ksort($subjects_array);
        // echo "<pre>";print_r($subjects_array);echo "</pre>";die();
        $data['subjects'] = $subjects_array;
        return view('front.user.print',$data);
    }


    public function get_result_history($id){
        $student = User::where('student_id',$id)->first();
        $exams    = CreateExam::where('session',$student->education_year)->get();
        if (count($exams) > 1) {
            return redirect()->back();
        }
        $exam_wise = array();
        $student_result = array();
        foreach ($exams as $key => $exam) {
            $exam_wise[$key]['exam'] = $exam->title;
            $subjects = $student->subject->pluck('subject_id');
            $st_subjects   = Subject::whereIn('id',$subjects)->get();
            $exam_wise[$key]['subjects'] = Subject::whereIn('id',$subjects)->get();
            
            $subject_details = array();
            $fail = 0;
            $total_subject_result = 0;
            $sum_gpa = 0;
            $st_sub_details = array();
            $total_mark = array();
            foreach ($st_subjects as $sub => $value) {
                // $sub = Subject::where('id',$value['id'])->first();
                $subject_details[$sub]['main_subject'] = $value->main_subject->name;
                $subject_details[$sub]['name'] = $value->name;
                $subject_details[$sub]['subject_code'] = $value['subject_code'];
                $subjectResult = ResultGenerate::where('exam_id',$exam->id)->where('subject_code',$value['subject_code'])->where('student_id',$student->student_id)->first();
                if (empty($exams)) {
                    return redirect()->back();
                }
                if(!empty($subjectResult)){
                    $sub_gpa = $subjectResult->gpa;
                    $total_mark[$sub] = $subjectResult->total_mark;
                    if($sub_gpa == 0){
                        $sub_gpa = "F";
                        $fail = 1;
                    }
                    $st_sub_details[$sub] = $sub_gpa;
                    $total_subject_result = $total_subject_result + 1;
                    $sum_gpa = $sum_gpa + $subjectResult->gpa;
                }else{
                    $st_sub_details[$sub] = 0;
                    $total_mark[$sub] = 0;
                }
            }
            // $student_result[$key] = $st_sub_details;
            $totalGpa = $sum_gpa/$total_subject_result;
            if($fail == 1){
                $totalGpa = 'F';
            }
            // $student_result[$key]['gpa'] = $totalGpa;
            $exam_wise[$key]['results']   = $st_sub_details;
            $exam_wise[$key]['totalMarks']   = $total_mark;
            $exam_wise[$key]['total_gpa'] = $totalGpa;
            // ===============main subject result============

            
            $main_fail = 0;
            $main_total_subject_result = 0;
            $main_sum_gpa = 0;
            $main_subjects = Subject::select('main_subject_id')->whereIn('id',$subjects)->groupBy('main_subject_id')->get();
            $main_subject_list = array();
            $main_subject_result = array();
            foreach ($main_subjects as $ms => $value) {
                $mainSubject = MainSubject::where('id',$value->main_subject_id)->first();
                $main_subject_list[$ms] = $mainSubject;
                $subjects   = Subject::where('main_subject_id',$value->main_subject_id)->pluck('subject_code');

                $st_subject_check = StudentSubject::where('student_id',$student->student_id)->whereIn('subject_code',$subjects)->first();
                if(!empty($st_subject_check)){
                    $subject_status = $st_subject_check->details->subject_status;
                }else{
                    $subject_status = '';
                }
                
                $subjectResult = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->sum('total_mark');
                $count      = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->count('id');
                
                $totalMark  = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->pluck('gpa')->toArray();
                if ($count < 1) {
                    $main_gpa = 0;
                }else{
                    $main_gpa = $this->calculation_gpa($subjectResult/$count);
                    if($subject_status === '4th'){
                        $main_total_subject_result = $main_total_subject_result - 1;
                        $main_gpa = $main_gpa - 2;
                        if ($main_gpa < 0) {
                            $main_gpa = 0;
                        }
                    }
                    $main_sum_gpa = $main_sum_gpa + $main_gpa;
                    $main_total_subject_result = $main_total_subject_result + 1;
                }
                if(in_array("0.0",$totalMark)){
                    $main_fail = 1;
                    $main_gpa  = "F";
                }
                
                $main_subject_result[$ms]['result'] = $main_gpa;
                $main_subject_result[$ms]['status'] = $subject_status;
            }
            $main_total_gpa = $main_sum_gpa/$main_total_subject_result;
            if($main_total_gpa > 5){
                $main_total_gpa = "5.00";
            }
            $exam_wise[$key]['main_total_gpa'] = ($main_fail == 0)?$main_total_gpa:'F';

            $exam_wise[$key]['main_subjects_result'] = $main_subject_result;
            $exam_wise[$key]['main_subjects'] = $main_subject_list;
            // dd($main_subject_list);
            
        }
        $data['exam_wises'] = $exam_wise;
        $data['student'] = $student;
        return view('front.user.result-history',$data);

    }

    public function get_result_print($id){
        $student = User::where('student_id',$id)->first();
        $exams    = CreateExam::where('session',$student->education_year)->get();
        if (count($exams) > 1) {
            return redirect()->back();
        }
        $exam_wise = array();
        $student_result = array();
        foreach ($exams as $key => $exam) {
            $exam_wise[$key]['exam'] = $exam->title;
            $subjects = $student->subject->pluck('subject_id');
            $st_subjects   = Subject::whereIn('id',$subjects)->get();
            $exam_wise[$key]['subjects'] = Subject::whereIn('id',$subjects)->get();
            
            $subject_details = array();
            $fail = 0;
            $total_subject_result = 0;
            $sum_gpa = 0;
            $st_sub_details = array();
            $total_mark = array();
            foreach ($st_subjects as $sub => $value) {
                // $sub = Subject::where('id',$value['id'])->first();
                $subject_details[$sub]['main_subject'] = $value->main_subject->name;
                $subject_details[$sub]['name'] = $value->name;
                $subject_details[$sub]['subject_code'] = $value['subject_code'];
                $subjectResult = ResultGenerate::where('exam_id',$exam->id)->where('subject_code',$value['subject_code'])->where('student_id',$student->student_id)->first();
                if (empty($exams)) {
                    return redirect()->back();
                }
                if(!empty($subjectResult)){
                    $sub_gpa = $subjectResult->gpa;
                    $total_mark[$sub] = $subjectResult->total_mark;
                    if($sub_gpa == 0){
                        $sub_gpa = "F";
                        $fail = 1;
                    }
                    $st_sub_details[$sub] = $sub_gpa;
                    $total_subject_result = $total_subject_result + 1;
                    $sum_gpa = $sum_gpa + $subjectResult->gpa;
                }else{
                    $st_sub_details[$sub] = 0;
                    $total_mark[$sub] = 0;
                }
            }
            // $student_result[$key] = $st_sub_details;
            $totalGpa = $sum_gpa/$total_subject_result;
            if($fail == 1){
                $totalGpa = 'F';
            }
            // $student_result[$key]['gpa'] = $totalGpa;
            $exam_wise[$key]['results']   = $st_sub_details;
            $exam_wise[$key]['totalMarks']   = $total_mark;
            $exam_wise[$key]['total_gpa'] = $totalGpa;
            // ===============main subject result============

            
            $main_fail = 0;
            $main_total_subject_result = 0;
            $main_sum_gpa = 0;
            $main_subjects = Subject::select('main_subject_id')->whereIn('id',$subjects)->groupBy('main_subject_id')->get();
            $main_subject_list = array();
            $main_subject_result = array();
            foreach ($main_subjects as $ms => $value) {
                $mainSubject = MainSubject::where('id',$value->main_subject_id)->first();
                $main_subject_list[$ms] = $mainSubject;
                $subjects   = Subject::where('main_subject_id',$value->main_subject_id)->pluck('subject_code');

                $st_subject_check = StudentSubject::where('student_id',$student->student_id)->whereIn('subject_code',$subjects)->first();
                if(!empty($st_subject_check)){
                    $subject_status = $st_subject_check->details->subject_status;
                }else{
                    $subject_status = '';
                }
                
                $subjectResult = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->sum('total_mark');
                $count      = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->count('id');
                
                $totalMark  = ResultGenerate::where('exam_id',$exam->id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->pluck('gpa')->toArray();
                if ($count < 1) {
                    $main_gpa = 0;
                }else{
                    $main_gpa = $this->calculation_gpa($subjectResult/$count);
                    if($subject_status === '4th'){
                        $main_total_subject_result = $main_total_subject_result - 1;
                        $main_gpa = $main_gpa - 2;
                        if ($main_gpa < 0) {
                            $main_gpa = 0;
                        }
                    }
                    $main_sum_gpa = $main_sum_gpa + $main_gpa;
                    $main_total_subject_result = $main_total_subject_result + 1;
                }
                if(in_array("0.0",$totalMark)){
                    $main_fail = 1;
                    $main_gpa  = "F";
                }
                
                $main_subject_result[$ms]['result'] = $main_gpa;
                $main_subject_result[$ms]['status'] = $subject_status;
            }
            $main_total_gpa = $main_sum_gpa/$main_total_subject_result;
            if($main_total_gpa > 5){
                $main_total_gpa = "5.00";
            }
            $exam_wise[$key]['main_total_gpa'] = ($main_fail == 0)?$main_total_gpa:'F';

            $exam_wise[$key]['main_subjects_result'] = $main_subject_result;
            $exam_wise[$key]['main_subjects'] = $main_subject_list;
            // dd($main_subject_list);
            
        }
        $data['exam_wises'] = $exam_wise;
        $data['student'] = $student;
        return view('front.user.result-history-print',$data);

    }
}
