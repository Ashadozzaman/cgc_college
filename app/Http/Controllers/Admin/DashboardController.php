<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
       return view('admin.dashboard');
    }

    public function teachers_list(){
        $data['teachers'] = User::where('role_id',2)->get();
        return view('admin.user.teachers-list',$data);
    }

    public function students_list(){
        $data['students'] = User::where('role_id',3)->get();
        return view('admin.user.students-list',$data);
    }

    public function add_teacher(){
        return view('admin.user.add-teacher');
    }
    public function message_list(){
        $data['messages'] = Contact::orderBy('id','desc')->get();
        return view('admin.message.message-list',$data);
    }
    public function about_us(){
        $data['about_us'] = AboutUs::first();
        return view('admin.about_us.edit',$data);
    }
    public function principal_us(){
        $data['about_us'] = AboutUs::where('id',2)->first();
        return view('admin.about_us.about-principal',$data);
    }
    public function about_us_submit(Request $request){
        $id = $request->id;
        $data['description'] = $request->description;
        AboutUs::where('id',$id)->update($data);
        if($id == 1){
            return redirect()->route('admin.about_us')->with('success','About us updated');
        }else{
            return redirect()->route('admin.principal_us')->with('success','Principal About us updated');
        }
    }




    public function admin_profile($id){
        $data['user'] = User::findOrFail($id);
        return view('admin.profile_update',$data);
    }


    public function admin_profile_update(Request $request,$id){
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'full_name'  => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ]);
        if($request->password != null){
            $validated = $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);

            $data['password'] = Hash::make($request->password);
        }
        $data['full_name'] = $request->full_name;
        $data['email'] = $request->email;
        $user->update($data);
        return redirect()->back()->with('success','Profile Update Successfully');
    }
}
