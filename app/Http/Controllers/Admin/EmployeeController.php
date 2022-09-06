<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Designation;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employee::orderBy('order_by','asc')->get();
        return view('admin.employee.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['designations'] = Designation::get();
        return view('admin.employee.create',$data);
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
            $path = public_path('\assets\admin\images\employee'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        Employee::create($data);
        return redirect()->route('employee.index')->with('success','Teacher create Successfully!!');
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
        $data['employee'] = Employee::findOrFail($id);
        return view('admin.employee.edit',$data);
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
        $employee = Employee::findOrFail($id);
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
            $path = public_path('\assets\admin\images\employee'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
            if (isset($employee->image)) {
                $public_path = public_path().'/assets/admin/images/employee/'.$employee->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $employee->update($data);
        return redirect()->route('employee.index')->with('success','Teacher update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if (isset($employee->image)) {
            $public_path = public_path().'/assets/admin/images/employee/'.$employee->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Employee::destroy($id);
        return redirect()->route('employee.index')->with('success','Teacher delete Successfully!!');
    }
}
