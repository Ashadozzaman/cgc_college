<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Service;
use App\Models\Employee;
use App\Models\ServiceCategory;
use App\Models\Department;
use App\Models\Contact;
use App\Models\AdmissionInformation;
use App\Models\ImportantLink;
use App\Models\AboutUs;
use App\Models\AcademicCalendar;
use App\Models\Syllabus;
use App\Models\Result;
use App\Models\Routine;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\User;
use App\Models\Subject;
use App\Models\Certificate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        // $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $data['notices'] = Notice::where('status',1)->orderBy('id','desc')->paginate(5);
        $data['teachers'] = Employee::orderBy('order_by','desc')->get();
        $data['departments'] = Department::where('status',1)->get();
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        $data['services'] = Service::with('service_categories')->where('status',1)->orderBy('order_by','asc')->get();
        return view('front.index',$data);
    }
    public function notice_details($id){
        $data['notice'] = Notice::findOrFail($id);
        return view('front.notice-details',$data);
    }
    public function department_details($id){
        $data['departments'] = Department::where('status',1)->get();
        $data['department'] = Department::with('teachers')->findOrFail($id);
        return view('front.department-details',$data);
    }
    
    public function service_details($id){
        $data['service'] = ServiceCategory::findOrFail($id);
        return view('front.service-details',$data);
    }
    
    public function contact(){
        return view('front.contact');
    }
    public function faculty(){
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        $data['teachers'] = Employee::orderBy('order_by','asc')->get();
        return view('front.teachers',$data);
    }
    public function office_staffs(){
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        $data['office_staffs'] = Employee::orderBy('order_by','asc')->get();
        return view('front.office_staffs',$data);
    }
    
    public function principal_message(){
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        return view('front.principal-details',$data);
    }
    public function information($slag){
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        if($slag == "admission_information"){
            $data['title'] = 'Admission Information';
            $data['infos'] = AdmissionInformation::where('status',1)->orderBy('id','desc')->get();
        }else if($slag == "academic_calendar"){
            $data['title'] = 'Academic Calendar';
            $data['infos'] = AcademicCalendar::where('status',1)->orderBy('id','desc')->get();
        }else if($slag == "syllabus"){
            $data['title'] = 'Syllabus';
            $data['infos'] = Syllabus::where('status',1)->orderBy('id','desc')->get();
        }else if($slag == "internal"){
            $data['title'] = 'Internal Exam Result';
            $data['infos'] = Result::where('result_type',1)->where('status',1)->orderBy('id','desc')->get();
        }else if($slag == "public"){
            $data['title'] = 'Public Exam Result';
            $data['infos'] = Result::where('result_type',2)->where('status',1)->orderBy('id','desc')->get();
        }else if($slag == "routine"){
            $data['title'] = 'Routine';
            $data['infos'] = Routine::where('status',1)->orderBy('id','desc')->get();
        }else{
            return redirect()->back();
        }
        $data['slag'] = $slag;
        return view('front.admission_info',$data);
    }
    public function details_information($slag,$id){
        $data['important_links'] = ImportantLink::where('status',1)->orderBy('order_by','asc')->get();
        if($slag == "admission_information"){
            $data['title'] = 'Admission Information';
            $data['infos'] = AdmissionInformation::where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else if($slag == "academic_calendar"){
            $data['title'] = 'Academic Calendar';
            $data['infos'] = AcademicCalendar::where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else if($slag == "syllabus"){
            $data['title'] = 'Syllabus';
            $data['infos'] = Syllabus::where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else if($slag == "internal"){
            $data['title'] = 'Internal Exam Result';
            $data['infos'] = Result::where('result_type',1)->where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else if($slag == "public"){
            $data['title'] = 'Public Exam Result';
            $data['infos'] = Result::where('result_type',2)->where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else if($slag == "routine"){
            $data['title'] = 'Routine';
            $data['infos'] = Routine::where('status',1)->where('id',$id)->orderBy('id','desc')->first();
        }else{
            return redirect()->back();
        }
        $data['slag'] = $slag;
        return view('front.information-details',$data);
        
    }

    public function image_gallery(){
        $data['images'] = Gallery::orderBy('id','desc')->paginate(8);
        return view('front.gallery',$data);
    }

    public function back(){
        return redirect()->back();
    }
    
    public function about(){
        $id = 1;
        $data['about'] = AboutUs::findOrFail($id);
        return view('front.about',$data);
    }
    public function about_principal(){
        $id = 2;
        $data['about'] = AboutUs::findOrFail($id);
        return view('front.about-principal',$data);
    }
    public function contact_submit(Request $request){
        $data = $request->except('_token','submit');
        Contact::create($data);
        return redirect()->route('contact')->with('success','Your message send Successfully!!');
    }
    public function admin_login(){
        return view('auth.admin.login');
    }
    public function student_login(){
        return view('auth.student.login');
    }
    public function student_register(){
        $data['sections'] = Section::where('certificate_id',1)->where('id','<>',4)->get();
        return view('auth.register-check',$data);
    }
    public function student_register_check(Request $request){
        $data['certificates'] = Certificate::get();
        $data['sections'] = Section::where('certificate_id',1)->get();
        $ssc_roll = $request->ssc_roll;
        $section_id = $request->section_id;
        $education_year = date('Y');
        $student  = User::where('ssc_roll',$ssc_roll)->where('section_id',$section_id)->first();
        if(empty($student)){
            return redirect()->back()->with('error','Sorry!! You are not in the list...');
        }else if($student->status == 1){
            return redirect()->back()->with('error','You are already register...');
        }else{
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
            $data['student'] = $student;
            return view('auth.register',$data);
        }
    }
}
