<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\StudentImport;
use App\Models\Subject;
use App\Models\StudentSubject;
use App\Models\StudentDetails;
use App\Models\Certificate;
use PDF;
use QrCode;
use App\Models\ResultGenerate;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['students'] = User::where('status',0)->where('role_id',3)->get();
        return view('admin.students.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = Section::get();
        $data['certificates'] = Certificate::get();
        return view('admin.students.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'  => 'required',
            'section_id' => 'required',
            'ssc_roll' => 'required|unique:users',
            'education_year' => 'required',
            'certificate_id'    => 'required',
            'ssc_board'    => 'required',
            'gender'    => 'required',
        ]);

        $data = [
            'role_id'        => '3',
            'full_name'      => $request->full_name,
            'section_id'     => $request->section_id,
            'ssc_roll'       => $request->ssc_roll,
            'education_year' => $request->education_year,
            'certificate_id'    => $request->certificate_id,
            'email'          => $request->ssc_roll.'@gmail.com',
            'password'       => bcrypt($request->ssc_roll),
        ];
        if($request->section_id == 1){
            $roll_start = 1000;
        }else if($request->section_id == 2){
            $roll_start = 2000;
        }else if($request->section_id == 3){
            $roll_start = 3000;
        }else{
            $roll_start = 4000;
        }
        $section = Section::findOrFail($request->section_id);
        if($section->certificate_id != $request->certificate_id){
            return redirect()->back()->with('error','Sorry certificate and section miss mess!!');
        }
        $user = User::where('education_year',$request->education_year)->where('section_id',$request->section_id)->orderBy('student_id','desc')->first();
        if(empty($user)){
            $class_roll = $roll_start + 1;
        }else{
            $class_roll = $user->class_roll + 1;
        }
        $data['student_id'] = (int) ($request->education_year.$class_roll);
        $data['class_roll'] = (int) $class_roll;
        // dd($data);
        User::create($data);
        return redirect()->route('student.index')->with('success','Student create Successfully!!');
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
        $data['sections'] = Section::get();
        $data['student']  = User::findOrFail($id);
        $data['certificates'] = Certificate::get();
        return view('admin.students.edit',$data);
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
        $data = $request->all();
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'full_name'  => 'required',
            'section_id' => 'required',
            'education_year' => 'required',
            'gender'    => 'required',
            'ssc_board'    => 'required',
            'certificate_id'    => 'required',
            'ssc_roll' => 'required|unique:users,ssc_roll,'.$id,
        ]);
        $section = Section::findOrFail($request->section_id);
        if($section->certificate_id != $request->certificate_id){
            return redirect()->back()->with('error','Sorry certificate and section miss mess!!');
        }
        $user->update($data);
        return redirect()->route('student.index')->with('success','Student Update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('student.index')->with('success','Student delete Successfully!!');
    }


    public function get_student(){
        $data['register_students'] = User::where('status',1)->where('role_id',3)->get();
        return view('admin.students.students-list',$data);
    }

    public function edit_student($id)
    {
        $data['sections'] = Section::get();
        $data['certificates'] = Certificate::get();
        $data['student']  = User::findOrFail($id);
        $student  = User::findOrFail($id);
        $section_id = $student->section_id;
        $chosseSubject = array();
        foreach ($student->subject as $k => $val) {
            $chosseSubject[$k] = $val->subject_id;
        }
        $resultGenerate = ResultGenerate::where('student_id',$student->student_id)->first();
        if(!empty($resultGenerate)){
            $data['resultGenerate'] = 1;
        }else{
            $data['resultGenerate'] = 0;
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
        return view('admin.students.student_edit',$data);
    }

    public function student_details_update(Request $request, $id){
        $user = User::findOrFail($id);
        $student_details =  StudentDetails::where('user_id',$id)->first();
        $validated = $request->validate([
            'full_name'  => 'required',
            'section_id' => 'required',
            'education_year' => 'required',
            'gender'    => 'required',
            'ssc_board'    => 'required',
            'certificate_id'    => 'required',
            'ssc_roll' => 'required|unique:users,ssc_roll,'.$id,
            'student_id' => 'required|unique:users,student_id,'.$id,
            'class_roll' => 'required',
            'phone'    => 'required',
            'section_id'    => 'required',
            'school'    => 'required',
            'ssc_reg'    => 'required',
            'father_name'    => 'required',
            'mother_name'    => 'required',
            'parents_phone'    => 'required',
            'birth_registration'    => 'required',
            'dob'    => 'required',
        ]);
        if($request->password != null){
            $validated = $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }
        if ($request->hasfile('image')) {
            $validated = $request->validate([
                'image' => ['mimes:jpeg,jpg,png','max:2048'],
            ]);
        }
        

        $data['user_id'] = $id;
        $data['ssc_roll']= $request->ssc_roll;
        $data['ssc_reg'] = $request->ssc_reg;
        $data['school']  = $request->school;
        $data['ssc_gpa'] = $request->ssc_gpa;
        $data['ssc_gpa_forth'] = $request->ssc_gpa_forth;
        $data['dob']         = $request->dob;
        $data['nationality'] = $request->nationality;
        $data['father_name'] = $request->father_name;
        $data['father_nid']  = $request->father_nid;
        $data['father_occupation'] = $request->father_occupation;
        $data['mother_name'] = $request->mother_name;
        $data['mother_nid']  = $request->mother_nid;
        $data['mother_occupation']    = $request->mother_occupation;
        $data['father_yearly_income'] = $request->father_yearly_income;
        $data['parents_phone']        = $request->parents_phone;
        $data['mother_yearly_income'] = $request->mother_yearly_income;
        $data['birth_registration']   = $request->birth_registration;
        $data['marital_status']       = $request->marital_status;
        $data['religion']             = $request->religion;
        $data['permanent_address']    = $request->permanent_address;
        $data['present_address']      = $request->present_address;
        $data['local_guardian_name']  = $request->local_guardian_name;
        $data['relation_local_guardian'] = $request->relation_local_guardian;
        $data['local_guardian_mobile']   = $request->local_guardian_mobile;
        $data['blood_group']             = $request->blood_group;

        $usdata['full_name']   = $request->full_name;
        $usdata['student_id']  = $request->student_id;
        $usdata['class_roll']  = $request->class_roll;
        $usdata['education_year']  = $request->education_year;
        $usdata['phone']  = $request->phone;
        $usdata['gender'] = $request->gender;
        $usdata['email']  = $request->email;
        $usdata['certificate_id']  = $request->certificate_id;
        $usdata['section_id']   = $request->section_id;
        $usdata['gender']       = $request->gender;
        $usdata['ssc_board']    = $request->ssc_board;
        $usdata['status'] = 1;
        if($request->password != null){
            $usdata['password'] = Hash::make($request->password);
        }
        if ($request->hasfile('image')) {
            $image     = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\front\images\user'); 
            $image->move($path,$imageName);
            $usdata['image'] = $imageName;
        }
        $user->update($usdata);
        $student_details->update($data);
        return redirect()->back()->with('success','Student Update Successfully !!');

    }

    public function change_subject_submit(Request $request){
        //dd($request->all());
        $id = $request->user_id;
        $user = User::where('id',$id)->first();
        StudentSubject::where('user_id',$id)->delete();
        foreach ($request->sub_subject as $key => $value) {
            // $stData['subject_id'] = $value;
            // $stData['user_id']    = $request->user_id;

            $subject = Subject::where('id',$value)->first();
            $stData['subject_id'] = $value;
            $stData['user_id']    = $user->id;
            $stData['student_id'] = $user->student_id;
            $stData['subject_code'] = $subject->subject_code;
            StudentSubject::create($stData);
        }
        return redirect()->back()->with('success','Change Successfully');
    }
    public function import_student(){
        return view('admin.students.import-excel');
    }
    public function submit_import_student(Request $request){
        $data = Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return redirect()->route('student.index')->with('success','Import Successfully');
    }
    // ======================================================================
    public function student_card_generate(){
        $data['sections'] = Section::where('id','<>',4)->get();
        $data['certificates'] = Certificate::get();
        $data['years'] = User::select('education_year')->where('education_year','<>',null)->groupBy('education_year')->get();
        return view('admin.students.card-generate',$data);
    }

    public function print_card(Request $request){
        $validated = $request->validate([
            'education_year'  => 'required',
            'certificate_id' => 'required',
            'section_id' => 'required',
        ]);
        
        $data['students'] = User::where('education_year',$request->education_year)->where('section_id',$request->section_id)->where('certificate_id',$request->certificate_id)->where('status',1)->get();
        
        // view()->share('users',$data);
        // $pdf = PDF::loadView('admin.students.print-card',$data)->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('pdfview.pdf');
        return view('admin.students.print-card',$data);
    }
}
