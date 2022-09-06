<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Designation;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['staffs'] = Staff::orderBy('order_by','asc')->get();
        return view('admin.staff.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['designations'] = Designation::get();
        return view('admin.staff.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($data);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'age' => 'required',
            'address' => 'required',
            'designation_id' => 'required',
            'gender' => 'required',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\staff'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        Staff::create($data);
        return redirect()->route('staff.index')->with('success','Staff create Successfully!!');
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
        $data['designations'] = Designation::get();
        $data['staff'] = Staff::findOrFail($id);
        return view('admin.staff.edit',$data);
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
        $staff = Staff::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'age' => 'required',
            'address' => 'required',
            'designation_id' => 'required',
            'gender' => 'required',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\staff'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
            if (isset($staff->image)) {
                $public_path = public_path().'/assets/admin/images/staff/'.$staff->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $staff->update($data);
        return redirect()->route('staff.index')->with('success','Staff update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Staff = Staff::findOrFail($id);
        if (isset($staff->image)) {
            $public_path = public_path().'/assets/admin/images/staff/'.$staff->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Staff::destroy($id);
        return redirect()->route('staff.index')->with('success','Staff delete Successfully!!');
    }
}
