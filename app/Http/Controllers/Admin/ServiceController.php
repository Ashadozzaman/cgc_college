<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = Service::orderBy('order_by','asc')->get();
        return view('admin.service.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
        ]);
        $data = $request->except('_token','image');

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\service'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        Service::create($data);
        return redirect()->route('service.index')->with('success','Service create Successfully!!');
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
        $data['service'] = Service::findOrFail($id);
        return view('admin.service.edit',$data);
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
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\service'); 
            $image->move($path,$imageName);
            // $filename = pathinfo($imageName, PATHINFO_FILENAME);
            // $image_name = $filename.'.'.$image->getClientOriginalExtension();
            $data['image'] = $imageName;
            if (isset($service->image)) {
                $public_path = public_path().'/assets/admin/images/service/'.$service->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $service->update($data);
        return redirect()->route('service.index')->with('success','Service update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if (isset($service->image)) {
            $public_path = public_path().'/assets/admin/images/service/'.$service->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Service::destroy($id);
        return redirect()->route('service.index')->with('success','Service delete Successfully!!');
    }
}
