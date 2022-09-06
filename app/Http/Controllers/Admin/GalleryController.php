<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['galleries'] = Gallery::get();
        return view('admin.gallery.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
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
            'order_by' => 'required',
            'image' => 'required',
        ]);
        $data = $request->except('_token','image');

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\gallery'); 
            $image->move($path,$imageName);
            $data['image'] = $imageName;
        }
        Gallery::create($data);
        return redirect()->route('gallery.index')->with('success','Gallery create Successfully!!');
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
        $data['gallery'] = Gallery::findOrFail($id);
        return view('admin.gallery.edit',$data);
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
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validate([
            'order_by' => 'required',
            'image' => 'required',
        ]);
        $data = $request->except('_token','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\gallery'); 
            $image->move($path,$imageName);
            $data['image'] = $imageName;
            if (isset($gallery->image)) {
                $public_path = public_path().'/assets/admin/images/gallery/'.$gallery->image;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $gallery->update($data);
        return redirect()->route('gallery.index')->with('success','Gallery update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if (isset($gallery->image)) {
            $public_path = public_path().'/assets/admin/images/gallery/'.$gallery->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Gallery::destroy($id);
        return redirect()->route('gallery.index')->with('success','Gallery delete Successfully!!');
    }
}
