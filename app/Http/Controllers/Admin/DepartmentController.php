<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['departments'] = Department::get();
        return view('admin.department.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
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
            'title' => 'required|max:255',
            'order_by' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except('_token','image');

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\department'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        Department::create($data);
        return redirect()->route('department.index')->with('success','Department create Successfully!!');
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
        $data['department'] = Department::findOrFail($id);
        return view('admin.department.edit',$data);
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
        $department = Department::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'order_by' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\department'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
            if (isset($department->image)) {
                $public_path = public_path().'/assets/admin/images/department/'.$department->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $department->update($data);
        return redirect()->route('department.index')->with('success','Department update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        if (isset($department->image)) {
            $public_path = public_path().'/assets/admin/images/department/'.$department->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Department::destroy($id);
        return redirect()->route('department.index')->with('success','Department delete Successfully!!');
    }
}
