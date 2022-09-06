<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreateExam;
use App\Models\Certificate;
class CreateExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['create_exams'] = CreateExam::orderBy('id','desc')->get();
        return view('admin.create_exam.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['certificates'] = Certificate::get();
        return view('admin.create_exam.create',$data);
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
            'session' => 'required',
            'certificate_id' => 'required',
        ]);
        $data = $request->except('_token');
        // dd($data);
        CreateExam::create($data);
        return redirect()->route('create_exam.index')->with('success','Exam Create create Successfully!!');
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
        $data['create_exam'] = CreateExam::findOrFail($id);
        $data['certificates'] = Certificate::get();
        return view('admin.create_exam.edit',$data);
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
        $create_exam = CreateExam::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'certificate_id' => 'required',
            'session' => 'required',
            'status' => 'required',
        ]);
        $data = $request->except('_token');
        $create_exam->update($data);
        return redirect()->route('create_exam.index')->with('success','Exam update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CreateExam::destroy($id);
        return redirect()->route('create_exam.index')->with('success','Exam delete Successfully!!');
    }
}
