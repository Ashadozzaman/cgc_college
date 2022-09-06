<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\TeacherAssign;
class TeacherAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teacher_assigns'] = TeacherAssign::get();
        return view('admin.teacher_assign.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['departments'] = Department::get();
        $data['teachers'] = Employee::orderBy('id','desc')->get();
        return view('admin.teacher_assign.create',$data);
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
            'teacher_id' => ['required', 'unique:teacher_assigns'],
            'department_id' => 'required',
        ]);
        $data = $request->except('_token');

        TeacherAssign::create($data);
        return redirect()->route('teacher_assign.index')->with('success','Teacher Assign Successfully!!');
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
        $data['departments'] = Department::get();
        $data['teachers'] = Employee::orderBy('id','desc')->get();
        $data['teacher_assign'] = TeacherAssign::findOrFail($id);
        return view('admin.teacher_assign.edit',$data);
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
        $teacher_assign = TeacherAssign::findOrFail($id);
        $validated = $request->validate([
            'teacher_id' => 'required',
            'department_id' => 'required',
        ]);
        $data = $request->except('_token');
        $teacher_assign->update($data);
        return redirect()->route('teacher_assign.index')->with('success','Teacher Assign update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TeacherAssign::destroy($id);
        return redirect()->route('teacher_assign.index')->with('success','Teacher Assign delete Successfully!!');
    }
}
