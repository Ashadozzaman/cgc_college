<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['medias'] = Media::get();
        return view('admin.media.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
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
            'file' => 'required',
        ]);
        $data = $request->except('_token','file');

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\media'); 
            $file->move($path,$fileName);
            $data['file'] = $fileName;
        }
        Media::create($data);
        return redirect()->route('media.index')->with('success','Media create Successfully!!');
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
        $data['media'] = Media::findOrFail($id);
        return view('admin.media.edit',$data);
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
        $media = Media::findOrFail($id);
        $validated = $request->validate([
            'file' => 'required',
        ]);
        $data = $request->except('_token','file');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\media'); 
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($media->file)) {
                $public_path = public_path().'/assets/admin/images/media/'.$media->file;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }

        $media->update($data);
        return redirect()->route('media.index')->with('success','Media update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if (isset($media->file)) {
            $public_path = public_path().'/assets/admin/images/media/'.$media->file;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        Media::destroy($id);
        return redirect()->route('media.index')->with('success','Media delete Successfully!!');
    }
}
