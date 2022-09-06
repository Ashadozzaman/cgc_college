<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Syllabus;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['syllabuses'] = Syllabus::get();
        return view('admin.academic_info.syllabus.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.academic_info.syllabus.create');
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
            'published_date' => 'required',
            'file' => ['required','mimes:pdf,png,jpg,jpeg','max:5048'],
        ]);
        $data = $request->except('_token','file');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            if ($file->getClientOriginalExtension() == 'pdf') {
                $path = public_path('\assets\admin\images\syllabus\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\syllabus\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            // $filename = pathinfo($fileName, PATHINFO_FILENAME);
            // $file_name = $filename.'.'.$file->getClientOriginalExtension();
            $data['file'] = $fileName;
        }
        Syllabus::create($data);
        return redirect()->route('syllabus.index')->with('success','Syllabus create Successfully!!');
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
        $data['syllabus'] = Syllabus::findOrFail($id);
        return view('admin.academic_info.syllabus.edit',$data);
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
        $syllabus = Syllabus::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'published_date' => 'required',
        ]);
        if ($request->hasfile('file')) {
            $validated = $request->validate([
                'file' => ['required','mimes:pdf,png,jpg,jpeg','max:5048'],
            ]); 
        }
        $data = $request->except('_token','image');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            if ($file->getClientOriginalExtension() == 'pdf') {
                $path = public_path('\assets\admin\images\syllabus\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\syllabus\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($syllabus->file)) {
                $public_path = public_path().'/assets/admin/images/syllabus/images/'.$syllabus->file;
                $public_path1 = public_path().'/assets/admin/images/syllabus/pdf/'.$syllabus->file;
                // dd($public_path);
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
                if (file_exists($public_path1)) {
                    unlink($public_path1);
                }
            }
        }
        $syllabus->update($data);
        return redirect()->route('syllabus.index')->with('success','Syllabus update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        if (isset($syllabus->file)) {
            $public_path = public_path().'/assets/admin/images/syllabus/images/'.$syllabus->file;
            $public_path1 = public_path().'/assets/admin/images/syllabus/pdf/'.$syllabus->file;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
            if (file_exists($public_path1)) {
                unlink($public_path1);
            }
        }
        Syllabus::destroy($id);
        return redirect()->route('syllabus.index')->with('success','Syllabus delete Successfully!!');
    }
}
