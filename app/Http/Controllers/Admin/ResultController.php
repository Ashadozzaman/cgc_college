<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['results'] = Result::get();
        return view('admin.result.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.result.create');
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
            'result_type' => 'required',
            'published_date' => 'required',
            'file' => ['required','mimes:pdf,png,jpg,jpeg','max:5048'],
        ]);
        $data = $request->except('_token','file');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            if ($file->getClientOriginalExtension() == 'pdf') {
                $path = public_path('\assets\admin\images\result\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\result\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            $data['file'] = $fileName;
        }
        Result::create($data);
        return redirect()->route('result.index')->with('success','Result create Successfully!!');
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
        $data['result'] = Result::findOrFail($id);
        return view('admin.result.edit',$data);
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
        $result = Result::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'result_type' => 'required',
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
                $path = public_path('\assets\admin\images\result\pdf');
                $data['is_pdf'] = 1;
            }else{
                $path = public_path('\assets\admin\images\result\images'); 
                $data['is_pdf'] = 0;
            }
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($result->file)) {
                $public_path = public_path().'/assets/admin/images/result/images/'.$result->file;
                $public_path1 = public_path().'/assets/admin/images/result/pdf/'.$result->file;
                // dd($public_path);
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
                if (file_exists($public_path1)) {
                    unlink($public_path1);
                }
            }
        }
        $result->update($data);
        return redirect()->route('result.index')->with('success','Result update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        if (isset($result->file)) {
            $public_path = public_path().'/assets/admin/images/result/images/'.$result->file;
            $public_path1 = public_path().'/assets/admin/images/result/pdf/'.$result->file;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
            if (file_exists($public_path1)) {
                unlink($public_path1);
            }
        }
        Result::destroy($id);
        return redirect()->route('result.index')->with('success','Result delete Successfully!!');
    }
}
