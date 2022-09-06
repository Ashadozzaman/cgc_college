<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreateExam;
use App\Models\Employee;
use App\Models\MarkSetup;
use App\Models\Certificate;
use App\Models\Subject;
use App\Models\Section;

class MarkSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['mark_setups'] = MarkSetup::orderBy('id','desc')->get();
        return view('admin.mark_setup.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['teachers'] = Employee::get();
        $data['exams'] = CreateExam::get();
        $data['sections'] = Section::where('certificate_id',1)->get();
        return view('admin.mark_setup.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'exam_id' => 'required',
            'subject_code' => 'required',
            'section_id' => 'required',
            'total_mark' => 'required',
            'cq' => 'required',
        ]);
        $data = $request->except('_token');
        $checkMark = MarkSetup::where('exam_id',$request->exam_id)
                    ->where('subject_code',$request->subject_code)
                    ->first();
        if (!empty($checkMark)) {
            return redirect()->back()->with('error','Subject already setup for this exam!!');
        }
        MarkSetup::create($data);
        return redirect()->route('mark_setup.index')->with('success','Mark setup Successfully!!');
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
        $data['mark_setup'] = MarkSetup::findOrFail($id);
        // dd($data);
        $data['teachers'] = Employee::get();
        $data['exams'] = CreateExam::get();
        $data['sections'] = Section::where('certificate_id',1)->get();
        return view('admin.mark_setup.edit',$data);
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
        $mark_setup = MarkSetup::findOrFail($id);
        $validated = $request->validate([
            'exam_id' => 'required',
            'subject_code' => 'required',
            'section_id' => 'required',
            'section_id' => 'required',
            'total_mark' => 'required',
            'cq' => 'required',
        ]);
        $checkMark = MarkSetup::where('exam_id',$request->exam_id)
                    ->where('subject_code',$request->subject_code)
                    ->where('id','<>',$id)
                    ->first();
        if (!empty($checkMark)) {
            return redirect()->back()->with('error','Subject already setup for this exam!!');
        }
        $data = $request->except('_token');
        // dd($data);
        $mark_setup->update($data);
        return redirect()->route('mark_setup.index')->with('success','Mark update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MarkSetup::destroy($id);
        return redirect()->route('mark_setup.index')->with('success','Mark delete Successfully!!');
    }


    public function subject_choose(Request $request){
        $exam_id = $request->exam_id;
        $section_id = $request->section_id;
        $exam = CreateExam::where('id',$exam_id)->first();
        $subjects = Subject::select('name','subject_code')->where('section_id',$section_id)->get();
        $subject_list = array();
        $codes = array();
        $i = 0;
        foreach ($subjects as $key => $value) {
            if(!in_array($value->subject_code,$codes)){
                $codes[$key] = $value->subject_code;
                $subject_list[$i]['name'] = $value->name;
                $subject_list[$i]['subject_code'] = $value->subject_code;
                $i = $i + 1;
            }
        }
        return \Response::json(['success'=>'success','data'=>$subject_list]);
    }
}
