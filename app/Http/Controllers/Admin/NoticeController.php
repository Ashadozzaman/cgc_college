<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Department;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['notices'] = Notice::orderBy('id','desc')->get();
        return view('admin.notice.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['departments'] = Department::get();
        return view('admin.notice.create',$data);
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
            'notice_by' => 'required',
            'department_id' => 'required',
            'published_date' => 'required',
            'file' => ['required','mimes:pdf,png,jpg,jpeg','max:5048'],
        ]);
        $data = $request->except('_token','file');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            if ($file->getClientOriginalExtension() == 'pdf') {
                $path = public_path('\assets\admin\images\notice\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\notice\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            // $filename = pathinfo($fileName, PATHINFO_FILENAME);
            // $file_name = $filename.'.'.$file->getClientOriginalExtension();
            $data['file'] = $fileName;
        }
        Notice::create($data);
        return redirect()->route('notice.index')->with('success','notice create Successfully!!');
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
        $data['notice'] = Notice::findOrFail($id);
        return view('admin.notice.edit',$data);
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
        $notice = Notice::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'notice_by' => 'required',
            'department_id' => 'required',
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
                $path = public_path('\assets\admin\images\notice\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\notice\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($notice->file)) {
                $public_path = public_path().'/assets/admin/images/notice/images/'.$notice->file;
                $public_path1 = public_path().'/assets/admin/images/notice/pdf/'.$notice->file;
                // dd($public_path);
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
                if (file_exists($public_path1)) {
                    unlink($public_path1);
                }
            }
        }
        $notice->update($data);
        return redirect()->route('notice.index')->with('success','notice update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        if (isset($notice->file)) {
            $public_path = public_path().'/assets/admin/images/notice/images/'.$notice->file;
            $public_path1 = public_path().'/assets/admin/images/notice/pdf/'.$notice->file;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
            if (file_exists($public_path1)) {
                unlink($public_path1);
            }
        }
        Notice::destroy($id);
        return redirect()->route('notice.index')->with('success','notice delete Successfully!!');
    }
}
