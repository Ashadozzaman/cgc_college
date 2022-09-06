<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Section;
use App\Models\MainSubject;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subjects'] = Subject::orderBy('order_by','asc')->get();
        return view('admin.subject.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = Section::get();
        $data['main_subjects'] = MainSubject::get();
        $data['certificates'] = Certificate::get();
        return view('admin.subject.create',$data);
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
            'name' => 'required|max:255',
            'main_subject_id' => 'required|max:255',
            'subject_code' => 'required|max:255',
            'certificate_id' => 'required|max:255',
            'section_id' => 'required|max:255',
            'subject_status' => 'required|max:255',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token');
        Subject::create($data);
        return redirect()->route('subject.index')->with('success','Subject create Successfully!!');
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
        $data['subject'] = Subject::findOrFail($id);
        $data['sections'] = Section::get();
        $data['main_subjects'] = MainSubject::get();
        $data['certificates'] = Certificate::get();
        return view('admin.subject.edit',$data);
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
        $subject = Subject::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'main_subject_id' => 'required|max:255',
            'subject_code' => 'required|max:255',
            'certificate_id' => 'required|max:255',
            'section_id' => 'required|max:255',
            'subject_status' => 'required|max:255',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token');
        $subject->update($data);
        return redirect()->route('subject.index')->with('success','Subject update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect()->route('subject.index')->with('success','Subject delete Successfully!!');
    }
}
