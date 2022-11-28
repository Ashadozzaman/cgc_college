<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarkSetup;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use App\Models\ResultGenerate;
use App\Http\Traits\Calculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ResultImport;
use App\Models\CreateExam;
use App\Models\Section;
use App\Models\MainSubject;
use PDF;
use Illuminate\Support\Facades\DB;

class ResultGenerateController extends Controller
{
    use Calculation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    ///result generate
    public function result_create($id)
    {
        $markDetails = MarkSetup::findOrFail($id);
        $data['markDetails'] = MarkSetup::findOrFail($id);
        $subject_code   = $markDetails->subject_code;
        $education_year = $markDetails->exam->session;
        $subjects = Subject::where('subject_code',$subject_code)->pluck('id');
        $students = StudentSubject::whereIn('subject_id',$subjects)->pluck('user_id');
        $subject_students = User::select('id','full_name','student_id','class_roll','section_id','image','education_year')
                                    ->whereIn('id',$students)->where('education_year',$education_year)
                                    ->where('status',1)->get();
        foreach ($subject_students as $key => $value) {
            $updata['exam_id'] = $markDetails->exam_id;
            $updata['mark_setup_id'] = $id;
            $updata['subject_code'] = $markDetails->subject_code;
            $updata['student_id'] = $value->student_id;
            // dd($updata);
            ResultGenerate::updateOrCreate(['exam_id'=>$markDetails->exam_id,'mark_setup_id'=>$id,'subject_code'=>$markDetails->subject_code,'student_id'=>$value->student_id],$updata);
        }
        $data['result_details'] = ResultGenerate::where('exam_id',$markDetails->exam_id)->where('subject_code',$markDetails->subject_code)
                                ->where('mark_setup_id',$id)->get();
        // dd($data['result_details']);
        return view('admin.result-generate.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['mark_setup_id'] = $request->mark_setup_id;
        $data['subject_code']  = $request->subject_code;
        $data['exam_id']       = $request->exam_id;
        $markDetails = MarkSetup::where('id',$request->mark_setup_id)->first();
        $cq_pass  = $this->pass_mark($markDetails->cq);
        $mcq_pass = $this->pass_mark($markDetails->mcq);
        $practical_pass = $this->pass_mark($markDetails->practical);
        // dd($cq_pass);
        foreach ($request->id as $key => $value) {
            $id = $value;
            $data['id']  = $value;
            $data['student_id']  = $request->student_id[$key];
            $data['cq']  = $request->cq[$key];
            $data['mcq'] = $request->mcq[$key];
            $data['practical'] = $request->practical[$key];
            $data['total_mark'] = $request->cq[$key] + $request->mcq[$key] + $request->practical[$key];
            if($cq_pass > $request->cq[$key]){
                $data['gpa'] = "0.00";
            }else if($mcq_pass > $request->mcq[$key]){
                $data['gpa'] = "0.00";
            }else if($practical_pass > $request->practical[$key]){
                $data['gpa'] = "0.00";
            }else{
                $data['gpa'] = $this->calculation_gpa($data['total_mark']);
            }
            ResultGenerate::where('id',$id)->update($data);
            //dd($data);
        }
        return redirect()->back()->with('success','Result Generate Successfull!!');
    }
    // ==================excel file import result by ================
    public function result_import(Request $request){
        $items = $request->except('_token','file');
        // dd($items);
        $data = Excel::import(new ResultImport($items), $request->file('file'));
        return redirect()->back()->with('success','Result Generate Successfull!!');
    }


    // ==================redirect result view initial page ================
    public function get_result(){
        $data['exams'] = CreateExam::where('status',1)->orderBy('id','desc')->get();
        $data['exams'] = CreateExam::where('status',1)->orderBy('id','desc')->get();
        $data['section'] = Section::where('certificate_id',1)->where('id','!=',4)->get();
        return view('admin.result-generate.get-result',$data);
    }

    // ======================exam result==================

    public function get_result_each_exam(Request $request){
        $exam_id = $request->exam_id;
        $exam_results  = ResultGenerate::where('exam_id',$exam_id)->get();
        $subjects = ResultGenerate::select('subject_code')->where('exam_id',$exam_id)->groupBy('subject_code')->get();
        $details = array();
        foreach ($subjects as $key => $value) {
            $details[$key]['name'] = $value->subject->name;
            $details[$key]['result'] = ResultGenerate::where('exam_id',$exam_id)->where('subject_code',$value->subject->subject_code)->get();
        }
        $data['details'] = $details;
        // echo "<pre>";print_r($details);echo "</pre>";die();
        return view('admin.result-generate.result-details',$data);
    }

    // ===================================================
    public function get_result_section(Request $request){
        $section_id = $request->section_id;
        $exam_id    = $request->exam_id;
        $exam = CreateExam::where('id',$exam_id)->first();
        if ($section_id == 4) {
            $students = User::where('education_year',$exam->session)->where('status',1)->get();
            $section = [1,2,3,4];
        }else{
            $students = User::where('section_id',$section_id)->where('education_year',$exam->session)->where('status',1)->get();
            $section = [(int)($section_id),4];
        }
        $subject_codes = Subject::select('subject_code')->whereIn('section_id',$section)->groupBy('subject_code')->get();
        $subject_mains = Subject::select('main_subject_id')->whereIn('section_id',$section)->groupBy('main_subject_id')->get();
        $student_result = array();
        foreach($students as $st => $student){
            $student_result[$st]['student'] = $student->full_name;
            $student_result[$st]['student_id'] = $student->student_id;
            $student_result[$st]['class_roll'] = $student->class_roll;
            $subject_details = array();
            $fail = 0;
            $total_subject_result = 0;
            $sum_gpa = 0;
            $st_sub_details = array();
            foreach ($subject_codes as $key => $value) {
                $sub = Subject::where('subject_code',$value['subject_code'])->first();
                $subject_details[$key]['main_subject'] = $sub->main_subject->name;
                $subject_details[$key]['name'] = $sub->name;
                $subject_details[$key]['subject_code'] = $value['subject_code'];
                $subjectResult = ResultGenerate::where('exam_id',$exam_id)->where('subject_code',$value['subject_code'])->where('student_id',$student->student_id)->first();
                if(!empty($subjectResult)){
                    $sub_gpa = $subjectResult->gpa;
                    if($sub_gpa == 0){
                        $sub_gpa = "F";
                        $fail = 1;
                    }
                    $st_sub_details[$key] = $sub_gpa;
                    $total_subject_result = $total_subject_result + 1;
                    $sum_gpa = $sum_gpa + $subjectResult->gpa;
                }else{
                    $st_sub_details[$key] = 0;
                }
            }
            $student_result[$st]['results'] = $st_sub_details;
            // $totalGpa = $sum_gpa/$total_subject_result;;
            if($sum_gpa == 0 || $total_subject_result == 0){
                $totalGpa = 0;
            }else{
                $totalGpa = $sum_gpa/$total_subject_result;
            }
            if($fail == 1){
                $totalGpa = 'F';
            }
            $student_result[$st]['gpa'] = $totalGpa;

        }
        $data['subject_details'] = $subject_details;
        $data['subject_result_details'] = $student_result;
        // dd($student_result);
        return view('admin.result-generate.result-details-section',$data);
    }

    //full subject result
    public function get_result_full_subject(Request $request){
        $section_id = $request->section_id;
        $exam_id    = $request->exam_id;
        $exam = CreateExam::where('id',$exam_id)->first();
        if ($section_id == 4) {
            $students = User::where('education_year',$exam->session)->where('status',1)->get();
            $section = [1,2,3,4];
        }else{
            $students = User::where('section_id',$section_id)->where('education_year',$exam->session)->where('status',1)->get();
            $students_ids = User::where('section_id',$section_id)->where('education_year',$exam->session)->where('status',1)->pluck('student_id');
            $section = [(int)($section_id),4];
        }
        $subject_codes = Subject::select('subject_code')->whereIn('section_id',$section)->groupBy('subject_code')->get();
        $subject_mains = Subject::select('main_subject_id')->whereIn('section_id',$section)->groupBy('main_subject_id')->get();

        //position generate
        $marks = ResultGenerate::select(
            DB::raw('sum(total_mark) as total_mark'), 'student_id')
            ->where('exam_id',$exam_id)
            ->whereIn('student_id',$students_ids->toArray())
            ->groupBy('student_id')
            ->get();
        $total_marks = array();
        foreach ($marks as $key => $value) {
            $total_marks[$key] = $value->total_mark;
        }
        arsort($total_marks);
        $sl = 1;
        $total_marks_sort = array();
        foreach ($total_marks as $tm => $value) {
            $total_marks_sort[$sl] = $value;
            $sl = $sl + 1;
        }

        $student_result = array();
        foreach($students as $st => $student){
            $student_result[$st]['student'] = $student->full_name;
            $student_result[$st]['student_id'] = $student->student_id;
            $student_result[$st]['class_roll'] = $student->class_roll;

            $subject_details = array();
            $fail = 0;
            $total_subject_result = 0;
            $sum_gpa = 0;
            $st_sub_details = array();
            foreach ($subject_codes as $key => $value) {
                $sub = Subject::where('subject_code',$value['subject_code'])->first();
                $subject_details[$key]['main_subject'] = $sub->main_subject->name;
                $subject_details[$key]['name'] = $sub->name;
                $subject_details[$key]['subject_code'] = $value['subject_code'];
                $subjectResult = ResultGenerate::where('exam_id',$exam_id)->where('subject_code',$value['subject_code'])->where('student_id',$student->student_id)->first();
                if(!empty($subjectResult)){
                    $sub_gpa = $subjectResult->gpa;
                    if($sub_gpa == 0){
                        $sub_gpa = "F";
                        $fail = 1;
                    }
                    $st_sub_details[$key]['gpa'] = $sub_gpa;
                    $st_sub_details[$key]['cq'] = $subjectResult->cq;
                    $st_sub_details[$key]['mcq'] = $subjectResult->mcq;
                    $st_sub_details[$key]['practical'] = $subjectResult->practical;
                    $total_subject_result = $total_subject_result + 1;
                    $sum_gpa = $sum_gpa + $subjectResult->gpa;
                }else{
                    $st_sub_details[$key]['gpa'] = 0;
                    $st_sub_details[$key]['cq'] = 0;
                    $st_sub_details[$key]['mcq'] = 0;
                    $st_sub_details[$key]['practical'] = 0;
                }
            }
            $student_result[$st]['results'] = $st_sub_details;
            // $totalGpa = $sum_gpa/$total_subject_result;;
            if($sum_gpa == 0 || $total_subject_result == 0){
                $totalGpa = 0;
            }else{
                $totalGpa = $sum_gpa/$total_subject_result;
            }
            if($fail == 1){
                $totalGpa = 'F';
            }
            $student_result[$st]['gpa'] = $totalGpa;
            $totalMarkAllSubject = ResultGenerate::where('exam_id',$exam_id)->where('student_id',$student->student_id)->sum('total_mark');
            $student_result[$st]['total_mark'] = $totalMarkAllSubject;

            //position
            $possition = array_search ($totalMarkAllSubject, $total_marks_sort);
            if($possition== 1){
                $possition = "1st";
            }elseif ($possition== 2) {
                $possition = "2nd";
            }elseif ($possition== 3) {
                $possition = "3rd";
            }else{
                $possition = $possition;
            }
            $student_result[$st]['possition']  = $possition;

        }
        $data['subject_details'] = $subject_details;
        $data['subject_result_details'] = $student_result;
        $data['exam'] = $exam;
        $data['section'] = Section::where('id',$section_id)->first();
        // dd($student_result);
        // $pdf = PDF::loadView('admin.result-generate.result-details-full-subject',$data)->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('result.pdf');
        return view('admin.result-generate.result-details-full-subject',$data);
    }

    public function get_result_main_subject(Request $request){
        $section_id = $request->section_id;
        $exam_id    = $request->exam_id;
        $exam = CreateExam::where('id',$exam_id)->first();
        if ($section_id == 4) {
            $students = User::where('education_year',$exam->session)->where('status',1)->get();
            $section = [1,2,3,4];
        }else{
            $students = User::where('section_id',$section_id)->where('education_year',$exam->session)->where('status',1)->get();
            $students_ids = User::where('section_id',$section_id)->where('education_year',$exam->session)->where('status',1)->pluck('student_id');
            $section = [(int)($section_id),4];
        }
        $subject_codes = Subject::select('subject_code')->whereIn('section_id',$section)->groupBy('subject_code')->get();
        $subject_mains = Subject::select('main_subject_id')->whereIn('section_id',$section)->groupBy('main_subject_id')->get();
        $student_result = array();
        if (count($students) < 1) {
            return redirect()->back();
        }
        $marks = ResultGenerate::select(
            DB::raw('sum(total_mark) as total_mark'), 'student_id')
            ->where('exam_id',$exam_id)
            ->whereIn('student_id',$students_ids->toArray())
            ->groupBy('student_id')
            ->get();
        $total_marks = array();
        foreach ($marks as $key => $value) {
            $total_marks[$key] = $value->total_mark;
        }
        arsort($total_marks);
        $sl = 1;
        $total_marks_sort = array();
        foreach ($total_marks as $tm => $value) {
            $total_marks_sort[$sl] = $value;
            $sl = $sl + 1;
        }
        foreach($students as $st => $student){
            $student_result[$st]['student']    = $student->full_name;
            $student_result[$st]['student_id'] = $student->student_id;
            $student_result[$st]['class_roll'] = $student->class_roll;
            $totalMarkAllSubject = ResultGenerate::where('exam_id',$exam_id)->where('student_id',$student->student_id)->sum('total_mark');
            $student_result[$st]['total_mark'] = $totalMarkAllSubject;
            // $rr = $marks->where('student_id',$student->student_id)->first();
            $possition = array_search ($totalMarkAllSubject, $total_marks_sort);
            if($possition== 1){
                $possition = "1st";
            }elseif ($possition== 2) {
                $possition = "2nd";
            }elseif ($possition== 3) {
                $possition = "3rd";
            }else{
                $possition = $possition;
            }
            $student_result[$st]['possition']  = $possition;

            $total_subject_result = 0;
            $sum_gpa = 0;
            $fail = 0;
            $mainSubjectWiseMark = array();
            $mainSubjectGpa = array();
            $mainSubjects = array();
            foreach ($subject_mains as $sm => $value) {
                $mainSubjects[$sm]['mainSub'] = $value->main_subject->name;
                $mainSubjects[$sm]['mainSub_id'] = $value->main_subject->id;
                $subjects   = Subject::where('main_subject_id',$value->main_subject->id)->pluck('subject_code');
                $st_subject = StudentSubject::where('student_id',$student->student_id)->whereIn('subject_code',$subjects)->pluck('subject_id');
                $st_subject_check = StudentSubject::where('student_id',$student->student_id)->whereIn('subject_code',$subjects)->first();
                if(!empty($st_subject_check)){
                    $subject_status = $st_subject_check->details->subject_status;
                }else{
                    $subject_status = '';
                }
                $mainSubjectGpa[$sm]['mainSub_status'] = $subject_status;
                $count = ResultGenerate::where('exam_id',$exam_id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->count('id');
                $totalMark     = ResultGenerate::where('exam_id',$exam_id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->pluck('gpa')->toArray();

                $fullResults = ResultGenerate::select(DB::raw('SUM(total_mark) AS total_mark'),DB::raw('SUM(cq) AS cq'),DB::raw('SUM(mcq) AS mcq'),DB::raw('SUM(practical) AS practical'))
                                ->where('exam_id',$exam_id)->whereIn('subject_code',$subjects)
                                ->where('student_id',$student->student_id)->first();


                // $mainSubjects[$sm]['sub_subjects'] = $st_subject;
                if ($count < 1) {
                    $gpa = 0;
                    // specific marks
                    $cq = 0;
                    $mcq = 0;
                    $practical = 0;
                }else{
                    if ($count != 1) {
                        return redirect()->back();
                    }
                    $gpa = $this->calculation_gpa($fullResults->total_mark/$count);
                    // $gpa = $this->calculation_gpa($subjectResult/$count);
                    if($subject_status === '4th'){
                        $total_subject_result = $total_subject_result - 1;
                        $gpa = $gpa - 2;
                        if ($gpa < 0) {
                            $gpa = 0;
                        }
                    }
                    $sum_gpa = $sum_gpa + $gpa;
                    $total_subject_result = $total_subject_result + 1;
                    // specific marks
                    $cq = $fullResults->cq;
                    $mcq = $fullResults->mcq;
                    $practical = $fullResults->practical;
                }
                if(in_array("0.0",$totalMark)){
                    $fail = 1;
                    $gpa  = "F";
                }
                $mainSubjectGpa[$sm]['gpa'] = $gpa;
                $mainSubjectGpa[$sm]['cq'] = $cq;
                $mainSubjectGpa[$sm]['mcq'] = $mcq;
                $mainSubjectGpa[$sm]['practical'] = $practical;
            }
            $student_result[$st]['results'] = $mainSubjectGpa;
            // echo $sum_gpa;echo " ";echo $total_subject_result;echo "<br>";
            if($sum_gpa == 0 || $total_subject_result == 0){
                $total_gpa = 0;
            }else{
                $total_gpa = $sum_gpa/$total_subject_result;
                if($total_gpa > 5){
                    $total_gpa = "5.00";
                }
            }
            $student_result[$st]['total_gpa'] = ($fail == 0)?$total_gpa:'F';
        }

        $data['subject_result_details'] = $student_result;
        $data['mainSubjects'] = $mainSubjects;
        $data['exam'] = $exam;
        $data['section'] = Section::where('id',$section_id)->first();
        if($request->button == 'View'){
            return view('admin.result-generate.result-generate-with-markshit',$data);
        }else{
            // $pdf = PDF::loadView('admin.result-generate.result-print-with-markshit',$data)->setOptions(['defaultFont' => 'sans-serif']);
            // return $pdf->download('result.pdf');
            return view('admin.result-generate.result-print-with-markshit',$data);
        }

    }


    // ====================Get personal result===========================

    public function get_personal_result($id){
        $student = User::where('student_id',$id)->first();
        $exams    = CreateExam::where('session',$student->education_year)->get();
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
            if($sum_gpa == 0 || $total_subject_result == 0){
                $totalGpa = 0;
            }else{
                $totalGpa = $sum_gpa/$total_subject_result;
            }
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
        return view('admin.students.result-histroy',$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
