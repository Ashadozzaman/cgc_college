<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\Service;
class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['service_categories'] = ServiceCategory::orderBy('id','desc')->get();
        return view('admin.service_category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['services'] = Service::get();
        return view('admin.service_category.create',$data);
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
            'service_id' => 'required',
            'body' => 'required',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token','file');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path('\assets\admin\images\service_category'); 
                
            $file->move($path,$fileName);
            $data['image'] = $fileName;
        }
        ServiceCategory::create($data);
        return redirect()->route('service_category.index')->with('success','Service Category create Successfully!!');
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
        $data['services'] = Service::get();
        $data['service_category'] = ServiceCategory::findOrFail($id);
        return view('admin.service_category.edit',$data);
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
        $service_category = ServiceCategory::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'service_id' => 'required',
            'body' => 'required',
            'order_by' => 'required',
        ]);
        if ($request->hasfile('file')) {
            $validated = $request->validate([
                'file' => ['required','mimes:png,png,jpg,jpeg','max:5048'],
            ]); 
        }
        $data = $request->except('_token','image');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\service_category'); 
            
            $file->move($path,$fileName);
            $data['image'] = $fileName;
            if (isset($service_category->file)) {
                $public_path = public_path().'/assets/admin/images/service_category/'.$service_category->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }
        $service_category->update($data);
        return redirect()->route('service_category.index')->with('success','Service Category update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service_category = ServiceCategory::findOrFail($id);
        if (isset($service_category->file)) {
            $public_path = public_path().'/assets/admin/images/service_category/'.$service_category->image;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        ServiceCategory::destroy($id);
        return redirect()->route('notice.index')->with('success','Service Category delete Successfully!!');
    }
}
