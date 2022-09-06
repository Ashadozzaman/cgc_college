<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicCalendar;

class AcademicCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['academic_calendars'] = AcademicCalendar::get();
        return view('admin.academic_info.AcademicCalendar.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.academic_info.AcademicCalendar.create');
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
                $path = public_path('\assets\admin\images\academic_calendar\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\academic_calendar\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            // $filename = pathinfo($fileName, PATHINFO_FILENAME);
            // $file_name = $filename.'.'.$file->getClientOriginalExtension();
            $data['file'] = $fileName;
        }
        AcademicCalendar::create($data);
        return redirect()->route('academic_calendar.index')->with('success','Academic Calender create Successfully!!');
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
        $data['academic_calendar'] = AcademicCalendar::findOrFail($id);
        return view('admin.academic_info.AcademicCalendar.edit',$data);
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
        $academic_calendar = AcademicCalendar::findOrFail($id);
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
                $path = public_path('\assets\admin\images\academic_calendar\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\academic_calendar\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($academic_calendar->file)) {
                $public_path = public_path().'/assets/admin/images/academic_calendar/images/'.$academic_calendar->file;
                $public_path1 = public_path().'/assets/admin/images/academic_calendar/pdf/'.$academic_calendar->file;
                // dd($public_path);
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
                if (file_exists($public_path1)) {
                    unlink($public_path1);
                }
            }
        }
        $academic_calendar->update($data);
        return redirect()->route('academic_calendar.index')->with('success','Academic Calender update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academic_calendar = AcademicCalendar::findOrFail($id);
        if (isset($academic_calendar->file)) {
            $public_path = public_path().'/assets/admin/images/academic_calendar/images/'.$academic_calendar->file;
            $public_path1 = public_path().'/assets/admin/images/academic_calendar/pdf/'.$academic_calendar->file;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
            if (file_exists($public_path1)) {
                unlink($public_path1);
            }
        }
        AcademicCalendar::destroy($id);
        return redirect()->route('academic_calendar.index')->with('success','Academic Calender delete Successfully!!');
    }
}
