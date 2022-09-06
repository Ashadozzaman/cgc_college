<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportantLink;
class ImportantLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['important_links'] = ImportantLink::orderBy('order_by','asc')->get();
        return view('admin.important_link.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.important_link.create');
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
            'link' => 'required|max:255',
            'order_by' => 'required',
        ]);
        $data = $request->except('_token');

        ImportantLink::create($data);
        return redirect()->route('important_link.index')->with('success','Important link create Successfully!!');
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
        $data['important_link'] = ImportantLink::findOrFail($id);
        return view('admin.important_link.edit',$data);
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
        $important_link = ImportantLink::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'link' => 'required|max:255',
            'order_by' => 'required',
            'status' => 'required',
        ]);
        $data = $request->except('_token');
        $important_link->update($data);
        return redirect()->route('important_link.index')->with('success','Important link update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImportantLink::destroy($id);
        return redirect()->route('important_link.index')->with('success','Important link delete Successfully!!');
    }
}
