<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\StudentDetails;
use App\Models\StudentSubject;
use Image;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
    public function register(Request $request){
        $validated = $request->validate([
            'ssc_reg' => 'required|max:255',
            'full_name' => 'required|max:255',
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // dd($request->all());
        if ($request->hasfile('profile_image')) {
            $validated = $request->validate([
                'profile_image' => ['mimes:jpeg,jpg,png','max:2048'],
            ]);
        }
        $ssc_roll   = $request->ssc_roll;
        $section_id = $request->section_id;
        $checkuser = User::where('ssc_roll',$ssc_roll)->where('section_id',$section_id)->first();
        if(empty($checkuser)){
            return redirect()->back()->with('error','Your are not in the list, Please Check your SSC Roll!!');
        }

        $data['user_id'] = $checkuser->id;
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

        $usdata['status'] = 1;
        $usdata['phone']  = $request->phone;
        $usdata['gender'] = $request->gender;
        $usdata['email']  = $request->email;
        $usdata['password'] = Hash::make($request->password);
        if ($request->hasfile('profile_image')) {
            $image     = $request->file('profile_image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\front\images\user'); 

            $img = Image::make($image->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.'/'.$imageName);

            // $image->move($path,$imageName);
            $usdata['image'] = $imageName;
        }
        // dd($usdata);
        foreach ($request->sub_subject as $key => $value) {
            $subject = Subject::where('id',$value)->first();
            $stData['subject_id'] = $value;
            $stData['user_id']    = $checkuser->id;
            $stData['student_id'] = $checkuser->student_id;
            $stData['subject_code'] = $subject->subject_code;
            StudentSubject::create($stData);
        }
        $user    = User::where('ssc_roll',$ssc_roll)->where('section_id',$section_id)->update($usdata);
        $student = User::where('ssc_roll',$ssc_roll)->where('section_id',$section_id)->first();
        StudentDetails::create($data);
        Auth::login($student);
        return redirect()->route('home');
    }

    public function showRegistrationForm()
    {
        $data['sections'] = Section::where('certificate_id',1)->get();
        return view('auth.register-check', $data);
    }
    protected function create(array $data)
    {
        // dd($data);
    
        // return User::create([
        //     'first_name' => $data['first_name'],
        //     'last_name' => $data['last_name'],
        //     'email' => $data['email'],
        //     'role_id' => 3,
        //     'password' => Hash::make($data['password']),
        // ]);
    }
}
