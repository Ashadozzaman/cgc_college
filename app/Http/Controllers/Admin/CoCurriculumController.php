<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CoCurriculum;
use App\Models\Curriculum;
use App\Models\CurriculumImage;
class CoCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['co_curriculums'] = CoCurriculum::orderBy('id','desc')->get();
        return view('admin.co-curriculum.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['curriculums'] = Curriculum::get();
        return view('admin.co-curriculum.create',$data);
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
            'curriculum_id' => 'required',
            'published_date' => 'required',
            'file' => ['mimes:pdf','max:5048'],
            'image' => ['mimes:png,jpg,jpeg','max:5048'],
        ]);
        $data = $request->except('_token','file','images');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\curriculums\pdf'); 
            $file->move($path,$fileName);
            $data['file'] = $fileName;
        }
        $curriculum = CoCurriculum::create($data);
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $imagefile) {
                $image = $imagefile;
                $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
                $path = public_path('\assets\admin\images\curriculums\images'); 
                $image->move($path,$imageName);
                // $imagename = pathinfo($imageName, PATHINFO_FILENAME);
                // $image_name = $imagename.'.'.$image->getClientOriginalExtension();
                $idata['co_curriculum_id'] = $curriculum->id;
                $idata['image'] = $imageName;
                CurriculumImage::create($idata);
            }
        }
        return redirect()->route('co_curriculum.index')->with('success','Co-Curriculum create Successfully!!');
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
        $data['curriculums'] = Curriculum::get();
        $data['curriculum_images'] = CurriculumImage::where('co_curriculum_id',$id)->get();
        $data['co_curriculum'] = CoCurriculum::findOrFail($id);
        return view('admin.co-curriculum.edit',$data);
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
        $co_curriculum = CoCurriculum::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'curriculum_id' => 'required',
            'published_date' => 'required',
            'file' => ['mimes:pdf','max:5048'],
            'image' => ['mimes:png,jpg,jpeg','max:5048'],
        ]);
        $data = $request->except('_token','file','images');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $fileName = rand(0000,9999).time().'.'.$file->getClientOriginalExtension();
            $path = public_path('\assets\admin\images\curriculums\pdf'); 
            $file->move($path,$fileName);
            $data['file'] = $fileName;
            if (isset($co_curriculum->file)) {
                $public_path = public_path().'/assets/admin/images/curriculums/pdf/'.$co_curriculum->file;
                if (file_exists($public_path)) {
                    unlink($public_path);
                }
            }
        }
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $imagefile) {
                $image = $imagefile;
                $imageName = rand(0000,9999).time().'.'.$image->getClientOriginalExtension();
                $path = public_path('\assets\admin\images\curriculums\images'); 
                $image->move($path,$imageName);
                $idata['co_curriculum_id'] = $id;
                $idata['image'] = $imageName;
                CurriculumImage::create($idata);
            }
        }
        $co_curriculum->update($data);
        return redirect()->route('co_curriculum.index')->with('success','Co-Curriculum update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $co_curriculum = CoCurriculum::findOrFail($id);
        if (isset($co_curriculum->file)) {
            $public_path = public_path().'/assets/admin/images/curriculums/pdf/'.$co_curriculum->file;
            // $public_path1 = public_path().'/assets/admin/images/curriculums/pdf/'.$notice->file;
            // dd($public_path);
            if (file_exists($public_path)) {
                unlink($public_path);
            }
            // if (file_exists($public_path1)) {
            //     unlink($public_path1);
            // }
        }
        CoCurriculum::destroy($id);
        return redirect()->route('co_curriculum.index')->with('success','CoCurriculum delete Successfully!!');
    }


    public function delete_image(Request $request){
        $id = $request->id;
        $co_curriculum_image = CurriculumImage::where("id",$request->id)->first();
        if (isset($id)) {
            $public_path = public_path().'/assets/admin/images/curriculums/images/'.$co_curriculum_image->image;
            if (file_exists($public_path)) {
                unlink($public_path);
            }
        }
        CurriculumImage::destroy($id);
        return response()->json('success', 200);
    }
}
