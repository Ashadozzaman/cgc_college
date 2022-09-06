<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = Banner::get();
        return view('admin.banner.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'image' => 'required',
        ]);
        $data = $request->except('_token','image');

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\banner'); 
            $image->move($path,$imageName);
            $data['image'] = $imageName;
        }
        Banner::create($data);
        return redirect()->route('banner.index')->with('success','Banner create Successfully!!');
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
        $data['banner'] = Banner::findOrFail($id);
        return view('admin.banner.edit',$data);
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
        $banner = Banner::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\banner'); 
            $image->move($path,$imageName);
            $data['image'] = $imageName;
            if (isset($banner->image)) {
                $public_path = public_path().'/assets/admin/images/banner/'.$banner->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }
        $banner->update($data);
        return redirect()->route('banner.index')->with('success','Banner update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if (isset($banner->image)) {
            $public_path = public_path().'/assets/admin/images/banner/'.$banner->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Banner::destroy($id);
        return redirect()->route('banner.index')->with('success','Banner delete Successfully!!');
    }
}
